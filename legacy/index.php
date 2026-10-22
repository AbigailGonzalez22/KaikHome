<?php
declare(strict_types=1);

define('SITE_URL', 'https://www.kaikhome.com');
define('BASE_PATH', __DIR__);

/* Solo aplica al servidor embebido de desarrollo (`php -S`): en Apache/SiteGround,
   .htaccess ya excluye los archivos reales antes de llegar a index.php. Sin este
   check, `php -S ... index.php` intentaría rutear también css/js/img/pdf. */
if (PHP_SAPI === 'cli-server') {
    $assetPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $assetFile = __DIR__ . $assetPath;
    if ($assetPath !== '/' && is_file($assetFile)) {
        return false;
    }
}

if (file_exists(__DIR__ . '/config/config.php')) {
    require __DIR__ . '/config/config.php';
} else {
    // Sin config/config.php todavía: se usan los placeholders de config.example.php
    // (las páginas funcionan igual; el envío real de email requiere credenciales reales).
    require __DIR__ . '/config/config.example.php';
}

require __DIR__ . '/app/Router.php';
require __DIR__ . '/app/Controllers/PageController.php';
require __DIR__ . '/app/Controllers/ContactController.php';

$router = new Router();
$router->get('/', [PageController::class, 'home']);
$router->get('/bargas', [PageController::class, 'bargas']);
$router->get('/mentrida', [PageController::class, 'mentrida']);
$router->post('/contact', [ContactController::class, 'send']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($_SERVER['REQUEST_METHOD'], $path ?: '/');
