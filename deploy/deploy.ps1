# Compila el sitio (npm run build) y sube al servidor (por FTP) solo los archivos de dist/ que cambiaron.
# Uso: desde la raiz del proyecto, ejecutar:  .\deploy\deploy.ps1
# Alternativa automatica: cada push a main despliega con GitHub Actions (.github/workflows/deploy.yml).
# La primera vez: copiar .env.example a .env (en la raiz del proyecto) y completar
# los datos reales del FTP. .env esta en .gitignore, nunca se sube a git.

$ErrorActionPreference = "Stop"

$root = Split-Path -Parent $PSScriptRoot
$envFile = Join-Path $root ".env"

if (-not (Test-Path $envFile)) {
    Write-Host "No se encontro .env en la raiz del proyecto." -ForegroundColor Red
    Write-Host "Copia .env.example a .env y completa los datos del FTP." -ForegroundColor Yellow
    exit 1
}

$envVars = @{}
Get-Content $envFile | ForEach-Object {
    $line = $_.Trim()
    if ($line -and -not $line.StartsWith("#") -and $line.Contains("=")) {
        $key, $value = $line.Split("=", 2)
        $envVars[$key.Trim()] = $value.Trim()
    }
}

foreach ($required in @("FTP_HOST", "FTP_USER", "FTP_PASS")) {
    if (-not $envVars.ContainsKey($required) -or [string]::IsNullOrWhiteSpace($envVars[$required]) -or $envVars[$required] -eq "CHANGE_ME") {
        Write-Host "Falta completar '$required' en .env" -ForegroundColor Red
        exit 1
    }
}

$ftpHost = $envVars["FTP_HOST"]
$ftpPort = if ($envVars.ContainsKey("FTP_PORT") -and $envVars["FTP_PORT"]) { $envVars["FTP_PORT"] } else { "21" }
$ftpUser = $envVars["FTP_USER"]
$ftpPass = $envVars["FTP_PASS"]
$remotePath = if ($envVars.ContainsKey("FTP_REMOTE_PATH") -and $envVars["FTP_REMOTE_PATH"]) { $envVars["FTP_REMOTE_PATH"] } else { "/" }

$winscp = Get-ChildItem -Path "$env:LOCALAPPDATA\Programs\WinSCP", "C:\Program Files (x86)\WinSCP", "C:\Program Files\WinSCP" -Filter "WinSCP.com" -ErrorAction SilentlyContinue -Recurse | Select-Object -First 1 -ExpandProperty FullName

if (-not $winscp) {
    Write-Host "No se encontro WinSCP.com. Reinstala WinSCP." -ForegroundColor Red
    exit 1
}

Write-Host "Compilando el sitio..." -ForegroundColor Cyan
Push-Location $root
try {
    npm run build
    if ($LASTEXITCODE -ne 0) { Write-Host "La compilacion fallo." -ForegroundColor Red; exit 1 }
} finally {
    Pop-Location
}

$dist = Join-Path $root "dist"

# Nunca se pisan las credenciales SMTP que viven solo en el servidor
$exclude = "config/config.php"

$openCmd = "open ftp://$($ftpUser):$($ftpPass)@$($ftpHost):$($ftpPort)/ -passive=on"
$syncCmd = "synchronize remote -criteria=either -filemask=`"| $exclude`" `"$dist`" `"$remotePath`""

# Se arma un archivo de script para WinSCP en vez de pasar todo por linea de comandos:
# evita que PowerShell rompa el quoting anidado al invocar el .exe nativo.
$scriptFile = New-TemporaryFile
try {
    Set-Content -Path $scriptFile -Value @($openCmd, $syncCmd, "exit") -Encoding UTF8

    Write-Host "Sincronizando cambios con $ftpHost..." -ForegroundColor Cyan

    & $winscp /script="$scriptFile"

    if ($LASTEXITCODE -eq 0) {
        Write-Host "Deploy completo." -ForegroundColor Green
    } else {
        Write-Host "El deploy termino con errores (codigo $LASTEXITCODE)." -ForegroundColor Red
    }
} finally {
    Remove-Item -Path $scriptFile -ErrorAction SilentlyContinue
}
