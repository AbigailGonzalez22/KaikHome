# Kaik Home — Sitio Web

Sitio con arquitectura PHP MVC liviana (sin frameworks, sin Composer) para la promotora inmobiliaria Kaik Home (Toledo). Header, nav y footer viven en un solo lugar (partials reutilizados); las 3 páginas se sirven con URLs limpias a través de un front controller.

## Estructura

```
/
├── index.php                     → Front controller (única puerta de entrada)
├── .htaccess                     → Rewrite a index.php, redirects 301, HTTPS, caché, headers
├── .gitignore                    → Ignora config/config.php (secrets)
├── config/
│   ├── config.example.php        → Template committeado (placeholders)
│   └── config.php                → Credenciales reales — NO se commitea, crear a mano
├── app/
│   ├── Router.php                → Router mínimo (4 rutas)
│   ├── Controllers/
│   │   ├── PageController.php    → Home / Bargas / Méntrida (GET)
│   │   └── ContactController.php → /contact (POST) — formulario de contacto
│   ├── Services/
│   │   └── Mailer.php            → Envío de email vía PHPMailer + SMTP
│   └── views/
│       ├── layout.php            → Envoltorio <html> común
│       ├── partials/
│       │   ├── head.php          → title/meta/OG/canonical/JSON-LD por página
│       │   ├── header.php        → Header + nav (único, parametrizado)
│       │   ├── footer.php        → Footer (único)
│       │   └── fab-lightbox.php  → FAB + lightbox de planos (solo Bargas/Méntrida)
│       └── pages/
│           ├── home.php          → Contenido de Inicio
│           ├── bargas.php        → Contenido de Diana Residencial (Bargas)
│           ├── mentrida.php      → Contenido de Residencial Méntrida
│           └── 404.php           → Página no encontrada
├── vendor/phpmailer/src/         → PHPMailer (3 archivos, descargados a mano — sin Composer)
├── css/styles.css                → Estilos compartidos (sin cambios)
├── js/main.js                    → Menú móvil, smooth scroll, envío de formularios (sin cambios)
├── img/                          → Imágenes del sitio (ver IMAGENES-PENDIENTES.txt)
├── pdf/                          → Dossiers PDF descargables (ver DOSSIERS-PENDIENTES.txt)
├── sitemap.xml
└── robots.txt
```

Las URLs públicas ahora son limpias: `/`, `/bargas`, `/mentrida`. Las viejas `index.html`/`bargas.html`/`mentrida.html` redirigen con 301 a la ruta limpia (ver `.htaccess`).

## 1. Subir a SiteGround (FTP o File Manager)

**Por FTP (FileZilla u otro cliente):**
1. Entrá a SiteGround → Site Tools → Site → FTP Accounts y obtené las credenciales (host, usuario, contraseña, puerto 21).
2. Conectate con tu cliente FTP y navegá hasta la carpeta `public_html` (o la carpeta raíz del dominio).
3. Subí **todo el contenido** de este proyecto dentro de `public_html`: `index.php`, `.htaccess`, `app/`, `config/config.example.php` (ver paso 2 para el real), `vendor/`, `css/`, `js/`, `img/`, `pdf/`, etc.

**Por File Manager (más simple):**
1. Site Tools → Site → File Manager.
2. Entrá a `public_html`.
3. Subí el .zip del proyecto y usá "Extract" para descomprimirlo ahí mismo, o arrastrá los archivos/carpetas directamente.

Verificá que `.htaccess` se haya subido (algunos clientes FTP ocultan archivos que empiezan con punto; activá "mostrar archivos ocultos"). Sin `.htaccess` las URLs limpias no funcionan (todo pasa por `index.php` gracias a esas reglas de rewrite).

## 2. Configurar el formulario (SMTP real)

El formulario ya está completo (validación, honeypot anti-spam, ruteo por origen) y envía por **SMTP real vía PHPMailer** (más confiable que `mail()` nativo, menos probabilidad de terminar en spam).

1. En el servidor (o localmente, nunca en git), copiá `config/config.example.php` a `config/config.php`.
2. Completá con los datos reales:
   ```php
   define('SMTP_HOST', 'smtp.tu-proveedor.com');
   define('SMTP_PORT', 587);
   define('SMTP_ENCRYPTION', 'tls');
   define('SMTP_USER', 'no-responder@kaikhome.com');
   define('SMTP_PASS', 'la-contraseña-real');
   define('FROM_EMAIL', 'no-responder@kaikhome.com');

   define('DESTINATARIO_DEFAULT',  'hola@kaikhome.com');
   define('DESTINATARIO_BARGAS',   'bargas@kaikhome.com');
   define('DESTINATARIO_MENTRIDA', 'mentrida@kaikhome.com');
   ```
3. Creá la casilla `no-responder@kaikhome.com` (o la que uses como remitente) en SiteGround → Site Tools → Email, y usá esas mismas credenciales SMTP (host suele ser `mail.kaikhome.com` o similar, puerto 587 con TLS).
4. `config/config.php` está en `.gitignore` — nunca lo subas a git, solo al servidor por FTP/File Manager.

No hace falta tocar nada más: los 3 formularios (Inicio, Bargas, Méntrida) ya envían un campo oculto `origen` que rutea automáticamente al destinatario correcto.

## 3. Reemplazar las imágenes

Todas las imágenes son placeholders. La lista completa de nombres de archivo esperados está en `img/IMAGENES-PENDIENTES.txt`.

Pasos:
1. Prepará las imágenes reales con esos mismos nombres (recomendado: formato `.webp`, tamaños indicados en el archivo de referencia).
2. Subilas a la carpeta `img/` por FTP o File Manager, sobrescribiendo los placeholders.
3. No hace falta tocar el código: los `<img src="/img/...">` y los `background-image` ya apuntan a esos nombres.

Si cambiás de `.jpg` a `.webp`, actualizá la extensión en los `src`/`background-image` correspondientes dentro de `app/views/pages/home.php`, `bargas.php` y `mentrida.php`.

### Favicon y logo del header

Estos dos también son placeholders (no están en la lista de "cards", pero siguen el mismo mecanismo):

- **Favicon**: subí el archivo a `img/favicon.png` (ideal 512x512px). Ya está enlazado en `app/views/partials/head.php` (`<link rel="icon">` y `<link rel="apple-touch-icon">`), no hace falta tocar el código.
- **Logo del header/footer**: subí el archivo a `img/logo.png` (header) y `img/logo-footer.png` (footer). Formato horizontal con el wordmark incluido. Proporción recomendada 4:1 (ej. 480x120px), fondo transparente.

## 4. Dossiers PDF descargables

Los botones "Descargar dossier" de Bargas y Méntrida ya apuntan a archivos dentro de `pdf/` con el atributo `download`, así que al hacer clic el navegador descarga el PDF directamente, sin pasar por el formulario.

Nombres esperados (detalle completo en `pdf/DOSSIERS-PENDIENTES.txt`):

- `pdf/diana-residencial-dossier.pdf`
- `pdf/residencial-mentrida-dossier.pdf`

Simplemente subí los PDF reales a la carpeta `pdf/` con esos nombres exactos por FTP o File Manager; no hace falta editar el código.

## 5. Activar la integración a CRM (opcional)

Por defecto, `ContactController` **no** envía los datos a ningún CRM externo, solo por email. Para activarlo:

1. En `config/config.php`, descomentá y completá:
   ```php
   define('CRM_WEBHOOK_URL', 'https://tu-crm.example.com/webhook/leads');
   ```
2. En `app/Controllers/ContactController.php`, descomentá el bloque marcado como "INTEGRACIÓN OPCIONAL A CRM" (usa `curl` para enviar un JSON con nombre, email, asunto, mensaje y origen).
3. Confirmá que el hosting tenga la extensión `curl` de PHP habilitada (SiteGround la trae activada por defecto).

## 6. Video / Tour virtual (Bargas y Méntrida)

Los bloques de video muestran una imagen estática mientras el atributo `data-video-url=""` esté vacío. Para activar el embed:

1. Abrí `app/views/pages/bargas.php` o `mentrida.php`.
2. Buscá `<div class="video-frame" data-video-url="">` (y quitá el atributo `hidden` de la sección para que se muestre).
3. Pegá la URL de embed (YouTube, Vimeo, Matterport, etc.) dentro del atributo, por ejemplo:
   ```html
   <div class="video-frame" data-video-url="https://www.youtube.com/embed/XXXXXXX">
   ```
4. `js/main.js` reemplaza automáticamente la imagen por un `<iframe>` cuando detecta esa URL.

## 7. SEO — valores pendientes de completar

En `app/views/partials/head.php` hay placeholders marcados con `TODO` que deben reemplazarse antes de lanzar:

- **Google Analytics 4**: reemplazar las 3 ocurrencias de `G-XXXXXXXXXX` por el measurement ID real.
- **Google Search Console**: reemplazar `TODO_REEMPLAZAR_CODIGO_VERIFICACION` en el meta `google-site-verification` por el código real (o verificar por DNS en su lugar).
- **Favicon**: sigue siendo el placeholder de `img/favicon.png` (ver sección 3).

## Notas técnicas

- Sin frameworks ni CDNs de JS: todo el CSS y JS es propio. PHPMailer es la única dependencia externa, vendorizada a mano (sin Composer) en `vendor/phpmailer/`.
- `.htaccess` fuerza HTTPS, enruta todo a `index.php` para las URLs limpias, redirige 301 las `.html` viejas, comprime con gzip/deflate y cachea imágenes/CSS/JS por 1 año. El bloque de `www` ↔ `no-www` sigue comentado: activar solo uno según se necesite.
- SEO: cada página tiene title, meta description, canonical, Open Graph, Twitter Card y JSON-LD (schema.org) propios, definidos en `app/Controllers/PageController.php` e inyectados vía `app/views/partials/head.php`.
- **Color de marca**: el verde principal (botones, links, íconos, acentos) es la variable `--green-dark` en `css/styles.css`, actualmente `#558f6e`. Cambiar solo esa variable actualiza todo el sitio.
- **Animaciones**: las secciones con clase `.reveal` aparecen con un fade + desplazamiento sutil al hacer scroll (controlado por `IntersectionObserver` en `js/main.js`). Los botones tienen un barrido de brillo al pasar el mouse y un pequeño "hundimiento" al hacer clic. Todo respeta `prefers-reduced-motion` para accesibilidad.
- **Probar en local**: con PHP instalado, correr `php -S localhost:8000 index.php` desde la raíz del proyecto y abrir `http://localhost:8000/`, `/bargas`, `/mentrida`.
