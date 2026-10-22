<?php
/**
 * Copiar este archivo a config/config.php y completar con los valores reales.
 * config/config.php está en .gitignore — nunca commitear credenciales reales.
 */

/* --------------------------------------------------------------------------
   SMTP — casilla real de envío (ej. cuenta de correo creada en SiteGround)
   -------------------------------------------------------------------------- */
define('SMTP_HOST', 'mail.kaikhome.com');
define('SMTP_PORT', 465);
define('SMTP_ENCRYPTION', 'ssl'); // 'tls' (puerto 587) o 'ssl' (puerto 465)
define('SMTP_USER', 'no-responder@kaikhome.com');
define('SMTP_PASS', 'CHANGE_ME');
define('FROM_EMAIL', 'no-responder@kaikhome.com');

/* --------------------------------------------------------------------------
   Destinatarios del formulario de contacto, según el origen.
   Se puede poner más de un email separado por coma (ej. 'a@x.com,b@x.com').
   -------------------------------------------------------------------------- */
define('DESTINATARIO_DEFAULT',  'CHANGE_ME_DEFAULT_INBOX@kaikhome.com');
define('DESTINATARIO_BARGAS',   'CHANGE_ME_BARGAS_INBOX@kaikhome.com');
define('DESTINATARIO_MENTRIDA', 'CHANGE_ME_MENTRIDA_INBOX@kaikhome.com');

/* --------------------------------------------------------------------------
   Integración opcional a un CRM externo (desactivada por defecto).
   Para activarla: descomentar y completar con la URL real del webhook.
   -------------------------------------------------------------------------- */
// define('CRM_WEBHOOK_URL', 'https://tu-crm.example.com/webhook/leads');
