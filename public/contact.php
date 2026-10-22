<?php
/**
 * Endpoint del formulario de contacto (POST /contact.php, también /contact vía .htaccess).
 * Recibe los formularios del sitio (Inicio, Bargas, Méntrida), valida, aplica un honeypot
 * anti-spam y envía el email por SMTP con PHPMailer.
 * Devuelve siempre JSON: { success: bool, message: string }
 *
 * Credenciales: config/config.php (no está en git; se sube a mano al servidor).
 */
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

$configFile = __DIR__ . '/config/config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    error_log('Kaik Home: falta config/config.php');
    echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mensaje en este momento. Llámanos o escríbenos por email.']);
    exit;
}
require $configFile;
require __DIR__ . '/lib/Mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

/* Honeypot: el campo "website" está oculto para personas; los bots suelen rellenarlo.
   Si viene con contenido se descarta en silencio (respondemos success para no dar pistas). */
if (!empty($_POST['website'])) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
    exit;
}

$clean = static function (string $key, string $default = ''): string {
    return isset($_POST[$key]) ? trim(htmlspecialchars(strip_tags((string) $_POST[$key]), ENT_QUOTES, 'UTF-8')) : $default;
};

$nombre   = $clean('nombre');
$email    = isset($_POST['email']) ? filter_var(trim((string) $_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$telefono = $clean('telefono');
$asunto   = $clean('asunto', 'Consulta general');
$mensaje  = $clean('mensaje');
$origen   = $clean('origen', 'default');

$errores = [];
if ($nombre === '' || mb_strlen($nombre) < 2) {
    $errores[] = 'Escribe tu nombre.';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El email no es válido.';
}
if ($mensaje === '' || mb_strlen($mensaje) < 5) {
    $errores[] = 'Cuéntanos en qué podemos ayudarte.';
}
if ($errores) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(' ', $errores)]);
    exit;
}

switch ($origen) {
    case 'bargas':
        $destinatario = DESTINATARIO_BARGAS;
        break;
    case 'mentrida':
        $destinatario = DESTINATARIO_MENTRIDA;
        break;
    default:
        $destinatario = DESTINATARIO_DEFAULT;
}

$asuntoEmail = 'Kaik Home · Nuevo contacto (' . $origen . ') · ' . $nombre;

$cuerpo  = "Nueva consulta recibida desde el sitio web de Kaik Home\n\n";
$cuerpo .= "Origen: " . $origen . "\n";
$cuerpo .= "Nombre: " . $nombre . "\n";
$cuerpo .= "Email: " . $email . "\n";
$cuerpo .= "Teléfono: " . ($telefono !== '' ? $telefono : '—') . "\n";
$cuerpo .= "Asunto: " . $asunto . "\n\n";
$cuerpo .= "Mensaje:\n" . $mensaje . "\n";

$enviado = Mailer::send($destinatario, $asuntoEmail, $cuerpo, $email, $nombre);

/* Integración opcional a CRM (desactivada por defecto).
   Para activarla: definir CRM_WEBHOOK_URL en config/config.php y descomentar. */
/*
if (defined('CRM_WEBHOOK_URL')) {
    $ch = curl_init(CRM_WEBHOOK_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(compact('nombre', 'email', 'telefono', 'asunto', 'mensaje', 'origen')));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    curl_close($ch);
}
*/

if ($enviado) {
    echo json_encode(['success' => true, 'message' => 'Gracias, tu mensaje se envió correctamente. Te contactaremos pronto.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mensaje en este momento. Inténtalo más tarde o llámanos.']);
}
