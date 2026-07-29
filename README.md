# Kaik Home — Sitio Web

Sitio estático (HTML + CSS + JS vanilla) para la promotora inmobiliaria Kaik Home (Toledo). Incluye un único script PHP para el formulario de contacto.

## Estructura

```
/
├── index.html          → Página de Inicio
├── bargas.html          → Diana Residencial (Bargas)
├── mentrida.html         → Residencial Méntrida
├── css/styles.css       → Estilos compartidos
├── js/main.js            → Menú móvil, smooth scroll, envío de formularios
├── php/contact.php       → Handler del formulario de contacto
├── img/                  → Imágenes del sitio (ver IMAGENES-PENDIENTES.txt)
├── pdf/                  → Dossiers PDF descargables (ver DOSSIERS-PENDIENTES.txt)
├── sitemap.xml
├── robots.txt
└── .htaccess
```

## 1. Subir a SiteGround (FTP o File Manager)

**Por FTP (FileZilla u otro cliente):**
1. Entrá a SiteGround → Site Tools → Site → FTP Accounts y obtené las credenciales (host, usuario, contraseña, puerto 21).
2. Conectate con tu cliente FTP y navegá hasta la carpeta `public_html` (o la carpeta raíz del dominio).
3. Subí **todo el contenido** de este proyecto dentro de `public_html` (no la carpeta contenedora, sino los archivos y carpetas: `index.html`, `css/`, `js/`, `php/`, `img/`, etc.).

**Por File Manager (más simple):**
1. Site Tools → Site → File Manager.
2. Entrá a `public_html`.
3. Subí el .zip del proyecto y usá "Extract" para descomprimirlo ahí mismo, o arrastrá los archivos/carpetas directamente.

Verificá que `.htaccess` se haya subido (algunos clientes FTP ocultan archivos que empiezan con punto; activá "mostrar archivos ocultos").

## 2. Configurar el formulario (php/contact.php)

Abrí `php/contact.php` y editá las constantes al principio del archivo:

```php
const DESTINATARIO_DEFAULT  = 'hola@kaikhome.com';
const DESTINATARIO_BARGAS   = 'bargas@kaikhome.com';
const DESTINATARIO_MENTRIDA = 'mentrida@kaikhome.com';
const FROM_EMAIL = 'no-responder@kaikhome.com';
```

- Cambiá esos emails por las cuentas reales de destino.
- `FROM_EMAIL` debe ser una dirección del mismo dominio que el hosting (ej. `no-responder@kaikhome.com`) para que `mail()` de PHP no marque los correos como spam. Creá esa cuenta de email en SiteGround → Site Tools → Email.
- No hace falta tocar nada más: los 3 formularios (Inicio, Bargas, Méntrida) ya envían un campo oculto `origen` que rutea automáticamente al destinatario correcto.

## 3. Reemplazar las imágenes

Todas las imágenes son placeholders. La lista completa de nombres de archivo esperados está en `img/IMAGENES-PENDIENTES.txt`.

Pasos:
1. Prepará las imágenes reales con esos mismos nombres (recomendado: formato `.webp`, tamaños indicados en el archivo de referencia).
2. Subilas a la carpeta `img/` por FTP o File Manager, sobrescribiendo los placeholders.
3. No hace falta tocar el HTML: los `<img src="img/...">` y los `background-image` ya apuntan a esos nombres.

Si cambiás de `.jpg` a `.webp`, actualizá la extensión en los `src`/`background-image` correspondientes dentro de `index.html`, `bargas.html` y `mentrida.html`.

### Favicon y logo del header

Estos dos también son placeholders (no están en la lista de "cards", pero siguen el mismo mecanismo):

- **Favicon**: subí el archivo a `img/favicon.png` (ideal 512x512px). Ya está enlazado en el `<head>` de las 3 páginas (`<link rel="icon">` y `<link rel="apple-touch-icon">`), no hace falta tocar el HTML.
- **Logo del header/footer**: subí el archivo a `img/logo.png`. Este archivo reemplaza **todo** el bloque de marca (ya no hay texto "Kaik Home" al lado): tiene que ser el logo completo, formato horizontal, con el wordmark incluido. Proporción recomendada 4:1 (ej. 480x120px), fondo transparente. Se ve en el header (más grande) y en el footer (más chico) de las 3 páginas.

## 4. Dossiers PDF descargables

Los botones "Solicitar dossier PDF" de `bargas.html` (una por cada tipología) ya apuntan a archivos dentro de `pdf/` con el atributo `download`, así que al hacer clic el navegador descarga el PDF directamente, sin pasar por el formulario.

Nombres esperados (detalle completo en `pdf/DOSSIERS-PENDIENTES.txt`):

- `pdf/diana-residencial-vivienda-1-planta.pdf`
- `pdf/diana-residencial-vivienda-2-plantas.pdf`

Simplemente subí los PDF reales a la carpeta `pdf/` con esos nombres exactos por FTP o File Manager; no hace falta editar el HTML.

## 5. Activar la integración a CRM (opcional)

Por defecto, `php/contact.php` **no** envía los datos a ningún CRM externo, solo por email. Para activarlo:

1. Abrí `php/contact.php`.
2. Descomentá la constante `CRM_WEBHOOK_URL` y poné la URL real de tu webhook:
   ```php
   const CRM_WEBHOOK_URL = 'https://tu-crm.example.com/webhook/leads';
   ```
3. Descomentá el bloque de código marcado como "INTEGRACIÓN OPCIONAL A CRM" (usa `curl` para enviar un JSON con nombre, email, asunto, mensaje y origen).
4. Confirmá que el hosting tenga la extensión `curl` de PHP habilitada (SiteGround la trae activada por defecto).

## 6. Video / Tour virtual (Bargas y Méntrida)

Los bloques de video muestran una imagen estática mientras el atributo `data-video-url=""` esté vacío. Para activar el embed:

1. Abrí `bargas.html` o `mentrida.html`.
2. Buscá `<div class="video-frame" data-video-url="">`.
3. Pegá la URL de embed (YouTube, Vimeo, Matterport, etc.) dentro del atributo, por ejemplo:
   ```html
   <div class="video-frame" data-video-url="https://www.youtube.com/embed/XXXXXXX">
   ```
4. `js/main.js` reemplaza automáticamente la imagen por un `<iframe>` cuando detecta esa URL.

## Notas técnicas

- Sin frameworks ni CDNs de JS: todo el CSS y JS es propio.
- `.htaccess` fuerza HTTPS, comprime con gzip/deflate y cachea imágenes/CSS/JS por 1 año. Los bloques de `www` ↔ `no-www` y URLs limpias están comentados: activar solo uno según se necesite.
- SEO: cada página tiene title, meta description, canonical, Open Graph, Twitter Card y JSON-LD (schema.org) propios.
- **Color de marca**: el verde principal (botones, links, íconos, acentos) es la variable `--green-dark` en `css/styles.css`, actualmente `#558f6e`. Cambiar solo esa variable actualiza todo el sitio.
- **Animaciones**: las secciones con clase `.reveal` aparecen con un fade + desplazamiento sutil al hacer scroll (controlado por `IntersectionObserver` en `js/main.js`). Los botones tienen un barrido de brillo al pasar el mouse y un pequeño "hundimiento" al hacer clic. Todo respeta `prefers-reduced-motion` para accesibilidad.
