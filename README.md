# Kaik Home — Sitio web

Sitio estático hecho con [Astro](https://astro.build) para la promotora Kaik Home (Toledo). `npm run build` genera la carpeta `dist/` con HTML, CSS, JS e imágenes optimizadas (AVIF/WebP), que se sube por FTP al hosting. El formulario de contacto sigue en PHP (`public/contact.php` + PHPMailer).

## Estructura

```
src/
  content/
    promociones/        → una ficha JSON por promoción (bargas.json → /bargas)
    proximas/           → promociones "En preparación"
  assets/img/           → imágenes originales (Astro las optimiza al compilar)
  components/           → Header, Footer, HomeHero, PromoIndex, PlanDialog, ContactSection…
  pages/                → index.astro (inicio), [slug].astro (cada promoción), 404.astro
  data/site.ts          → teléfono, email, dirección, redes, GTM
  styles/global.css     → tokens y estilos base
  scripts/motion.ts     → scroll suave y animaciones (Lenis + GSAP)
public/
  .htaccess             → HTTPS, www, URLs limpias, redirects 301, caché
  contact.php           → endpoint del formulario
  lib/                  → Mailer + PHPMailer (bloqueado por HTTP)
  config/               → config.example.php (config.php real solo en el servidor)
  pdf/                  → dossiers descargables
legacy/                 → versión PHP anterior, solo como referencia
```

## Trabajar en local

Requiere Node 20 o superior.

```
npm install
npm run dev        # http://localhost:4321 con recarga en vivo
npm run build      # genera dist/
npm run preview    # sirve dist/ (en local usa /bargas.html; en el servidor /bargas funciona por .htaccess)
```

## Editar contenido

- **Cambiar datos de una promoción** (viviendas, m², % de obra, entrega, textos): editar `src/content/promociones/<promocion>.json`.
- **Nueva promoción**: duplicar un JSON, cambiar el nombre del archivo (será la URL) y sus imágenes en `src/assets/img/`.
- **Próximas promociones**: `src/content/proximas/*.json`.
- **Teléfono, email, dirección**: `src/data/site.ts`.

Si un dato no cumple el formato, `npm run build` falla y dice qué campo revisar. Más adelante se puede sumar un panel de edición (Keystatic o Decap) sobre estos mismos archivos.

## Publicar

**Automático (recomendado):** cada push a `main` compila y sube `dist/` con GitHub Actions (`.github/workflows/deploy.yml`). Configurar en GitHub → Settings → Secrets and variables → Actions:

| Secreto | Valor |
|---|---|
| `FTP_HOST` | host FTP del cPanel |
| `FTP_USER` / `FTP_PASS` | cuenta FTP |
| `FTP_SERVER_DIR` | carpeta destino con barra final. Para probar: la del subdominio (p. ej. `/nuevo.kaikhome.com/`). Para producción: `/public_html/` |

**Manual (Windows):** `.\deploy\deploy.ps1` compila y sincroniza `dist/` con WinSCP usando `.env`.

## Formulario (SMTP)

En el servidor, copiar `config/config.example.php` a `config/config.php` (dentro de la carpeta publicada) y completar las credenciales SMTP y los destinatarios por origen (`default`, `bargas`, `mentrida`). Esa carpeta está bloqueada por `.htaccess` y `config.php` nunca va a git ni lo pisa el deploy.

## Pendientes

- `pdf/residencial-mentrida-dossier.pdf` pesa 43 MB: conviene comprimirlo.
- Los enlaces de Aviso legal, Privacidad y Cookies del pie no tienen páginas todavía.
