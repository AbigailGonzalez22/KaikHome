<?php

require_once BASE_PATH . '/app/Services/Mailer.php';

/**
 * Handler del formulario de contacto — sucesor de php/contact.php.
 * Recibe los 3 formularios del sitio (Inicio, Bargas, Méntrida) vía fetch/POST.
 * Valida, sanitiza, aplica un honeypot anti-spam y envía el email vía SMTP (PHPMailer).
 * Devuelve siempre JSON: { success: bool, message: string }
 */
class ContactController
{
    public function send(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
            return;
        }

        /* Honeypot anti-spam: el campo "website" está oculto vía CSS para usuarios
           reales; los bots suelen rellenarlo automáticamente. Si viene con contenido,
           se descarta la petición silenciosamente (respondemos success para no dar pistas). */
        if (!empty($_POST['website'])) {
            echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
            return;
        }

        $nombre  = isset($_POST['nombre']) ? trim(htmlspecialchars(strip_tags($_POST['nombre']), ENT_QUOTES, 'UTF-8')) : '';
        $email   = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
        $asunto  = isset($_POST['asunto']) ? trim(htmlspecialchars(strip_tags($_POST['asunto']), ENT_QUOTES, 'UTF-8')) : 'Consulta general';
        $mensaje = isset($_POST['mensaje']) ? trim(htmlspecialchars(strip_tags($_POST['mensaje']), ENT_QUOTES, 'UTF-8')) : '';
        $origen  = isset($_POST['origen']) ? trim(htmlspecialchars(strip_tags($_POST['origen']), ENT_QUOTES, 'UTF-8')) : 'default';

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
            return;
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
        $cuerpo .= "Asunto: " . $asunto . "\n\n";
        $cuerpo .= "Mensaje:\n" . $mensaje . "\n";

        $enviado = Mailer::send($destinatario, $asuntoEmail, $cuerpo, $email, $nombre);

        /* Integración opcional a CRM (desactivada por defecto).
           Para activarla: definir CRM_WEBHOOK_URL en config/config.php y descomentar. */
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

        if ($enviado) {
            echo json_encode(['success' => true, 'message' => 'Gracias, tu mensaje se envió correctamente. Te contactaremos pronto.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'No se pudo enviar el mensaje en este momento. Intenta de nuevo más tarde.']);
        }
    }
}
