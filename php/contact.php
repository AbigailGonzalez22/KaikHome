<?php
/**
 * KAIK HOME — Handler del formulario de contacto
 * Recibe los 3 formularios del sitio (Inicio, Bargas, Méntrida) vía fetch/POST.
 * Valida, sanitiza, aplica un honeypot anti-spam y envía el email con mail().
 * Devuelve siempre JSON: { success: bool, message: string }
 */

header('Content-Type: application/json; charset=utf-8');

/* ==========================================================================
   CONFIGURACIÓN — EDITAR AQUÍ LOS EMAILS DE DESTINO Y EL DOMINIO
   ========================================================================== */
const DESTINATARIO_DEFAULT  = 'hola@kaikhome.com';
const DESTINATARIO_BARGAS   = 'bargas@kaikhome.com';
const DESTINATARIO_MENTRIDA = 'mentrida@kaikhome.com';

/* Dominio propio usado en la cabecera "From". Debe coincidir con el dominio
   del hosting SiteGround para evitar que el correo caiga en spam. */
const FROM_DOMINIO = 'kaikhome.com';
const FROM_EMAIL   = 'no-responder@kaikhome.com';

/* Integración opcional a un CRM externo (desactivada por defecto).
   Para activarla: descomentar la constante y el bloque curl más abajo. */
// const CRM_WEBHOOK_URL = 'https://tu-crm.example.com/webhook/leads';

/* ==========================================================================
   VALIDACIÓN DE MÉTODO
   ========================================================================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

/* ==========================================================================
   HONEYPOT ANTI-SPAM
   El campo "website" está oculto vía CSS para usuarios reales; los bots
   suelen rellenarlo automáticamente. Si viene con contenido, se descarta
   la petición silenciosamente (respondemos success para no dar pistas).
   ========================================================================== */
if (!empty($_POST['website'])) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
    exit;
}

/* ==========================================================================
   RECEPCIÓN Y SANITIZACIÓN DE CAMPOS
   ========================================================================== */
$nombre  = isset($_POST['nombre']) ? trim(htmlspecialchars(strip_tags($_POST['nombre']), ENT_QUOTES, 'UTF-8')) : '';
$email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$asunto  = isset($_POST['asunto']) ? trim(htmlspecialchars(strip_tags($_POST['asunto']), ENT_QUOTES, 'UTF-8')) : 'Consulta general';
$mensaje = isset($_POST['mensaje']) ? trim(htmlspecialchars(strip_tags($_POST['mensaje']), ENT_QUOTES, 'UTF-8')) : '';
$origen  = isset($_POST['origen']) ? trim(htmlspecialchars(strip_tags($_POST['origen']), ENT_QUOTES, 'UTF-8')) : 'default';

/* ==========================================================================
   VALIDACIÓN DE CAMPOS OBLIGATORIOS
   ========================================================================== */
$errores = [];

if ($nombre === '' || mb_strlen($nombre) < 2) {
    $errores[] = 'El nombre es obligatorio.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El email no es válido.';
}

if ($mensaje === '' || mb_strlen($mensaje) < 5) {
    $errores[] = 'El mensaje es obligatorio.';
}

if (!empty($errores)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(' ', $errores)]);
    exit;
}

/* ==========================================================================
   RUTEO DEL DESTINATARIO SEGÚN EL ORIGEN DEL FORMULARIO
   ========================================================================== */
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

/* ==========================================================================
   ENVÍO DEL EMAIL
   ========================================================================== */
$asuntoEmail = 'Kaik Home · Nuevo contacto (' . $origen . ') · ' . $nombre;

$cuerpo  = "Nueva consulta recibida desde el sitio web de Kaik Home\n\n";
$cuerpo .= "Origen: " . $origen . "\n";
$cuerpo .= "Nombre: " . $nombre . "\n";
$cuerpo .= "Email: " . $email . "\n";
$cuerpo .= "Asunto: " . $asunto . "\n\n";
$cuerpo .= "Mensaje:\n" . $mensaje . "\n";

$headers  = "From: Kaik Home <" . FROM_EMAIL . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$enviado = @mail($destinatario, $asuntoEmail, $cuerpo, $headers);

/* ==========================================================================
   INTEGRACIÓN OPCIONAL A CRM (desactivada por defecto)
   Para activarla: descomentar la constante CRM_WEBHOOK_URL arriba y
   este bloque completo.
   ========================================================================== */
/*
if (defined('CRM_WEBHOOK_URL')) {
    $payload = json_encode([
        'nombre'  => $nombre,
        'email'   => $email,
        'asunto'  => $asunto,
        'mensaje' => $mensaje,
        'origen'  => $origen,
    ]);

    $ch = curl_init(CRM_WEBHOOK_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    curl_close($ch);
}
*/

/* ==========================================================================
   RESPUESTA JSON
   ========================================================================== */
if ($enviado) {
    echo json_encode(['success' => true, 'message' => 'Gracias, tu mensaje se envió correctamente. Te contactaremos pronto.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mensaje en este momento. Intenta de nuevo más tarde.']);
}
