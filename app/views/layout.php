<?php
/**
 * Layout base: envuelve head + header + contenido de la página + footer.
 * @var string $contentView      ruta absoluta a app/views/pages/*.php
 * @var string|null $afterFooterView  ruta absoluta opcional (ej: FAB + lightbox)
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php require __DIR__ . '/partials/head.php'; ?>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WC5FL2PP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php require __DIR__ . '/partials/header.php'; ?>

<?php require $contentView; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>

<?php if (!empty($afterFooterView)): ?>
<?php require $afterFooterView; ?>
<?php endif; ?>

<script src="/js/main.js"></script>
</body>
</html>
