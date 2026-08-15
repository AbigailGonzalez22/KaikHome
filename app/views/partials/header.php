<?php
/** @var string $activeNav 'home' | 'bargas' | 'mentrida' */
$isPromo = in_array($activeNav, ['bargas', 'mentrida'], true);
?>
<!-- ==================== HEADER ==================== -->
<header class="site-header">
  <div class="container">
    <a href="/" class="logo" aria-label="Kaik Home — Inicio">
      <img class="logo-img" src="/img/logo.png" alt="Kaik Home" width="140" height="36">
    </a>

    <nav class="main-nav" aria-label="Navegación principal">
      <a href="/"<?= $activeNav === 'home' ? ' aria-current="page"' : '' ?>>Inicio</a>
      <div class="nav-dropdown">
        <button type="button" class="nav-dropdown-toggle<?= $isPromo ? ' is-active' : '' ?>" aria-expanded="false" aria-controls="promociones-menu">
          Promociones
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="nav-dropdown-menu" id="promociones-menu">
          <a href="/bargas"<?= $activeNav === 'bargas' ? ' aria-current="page"' : '' ?>>Bargas</a>
          <a href="/mentrida"<?= $activeNav === 'mentrida' ? ' aria-current="page"' : '' ?>>Méntrida</a>
        </div>
      </div>
    </nav>

    <div class="header-actions">
      <div class="social-icons">
        <a href="https://www.facebook.com/kaikhome/" target="_blank" rel="noopener" aria-label="Facebook de Kaik Home">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M13.5 8.5H15V6.2H13.3C11.65 6.2 10.5 7.43 10.5 9.1V10.7H9V13H10.5V18H13V13H14.6L15 10.7H13V9.1C13 8.76 13.16 8.5 13.5 8.5Z" fill="currentColor"/></svg>
        </a>
        <a href="https://www.instagram.com/kaikhome/" target="_blank" rel="noopener" aria-label="Instagram de Kaik Home">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>
        </a>
      </div>
      <a href="#contacto" class="btn btn-primary">Contactar</a>
      <button class="menu-toggle" aria-label="Abrir menú de navegación" aria-expanded="false">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
    </div>
  </div>

  <nav class="mobile-nav" aria-label="Navegación móvil">
    <a href="/"<?= $activeNav === 'home' ? ' aria-current="page"' : '' ?>>Inicio</a>
    <div class="mobile-nav-group">
      <button type="button" class="mobile-nav-toggle<?= $isPromo ? ' is-active' : '' ?>" aria-expanded="<?= $isPromo ? 'true' : 'false' ?>" aria-controls="mobile-promociones">
        Promociones
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="mobile-nav-submenu" id="mobile-promociones"<?= $isPromo ? '' : ' hidden' ?>>
        <a href="/bargas"<?= $activeNav === 'bargas' ? ' aria-current="page"' : '' ?>>Bargas</a>
        <a href="/mentrida"<?= $activeNav === 'mentrida' ? ' aria-current="page"' : '' ?>>Méntrida</a>
      </div>
    </div>
    <div class="header-actions">
      <div class="social-icons">
        <a href="https://www.facebook.com/kaikhome/" target="_blank" rel="noopener" aria-label="Facebook de Kaik Home">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M13.5 8.5H15V6.2H13.3C11.65 6.2 10.5 7.43 10.5 9.1V10.7H9V13H10.5V18H13V13H14.6L15 10.7H13V9.1C13 8.76 13.16 8.5 13.5 8.5Z" fill="currentColor"/></svg>
        </a>
        <a href="https://www.instagram.com/kaikhome/" target="_blank" rel="noopener" aria-label="Instagram de Kaik Home">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>
        </a>
      </div>
      <a href="#contacto" class="btn btn-primary">Contactar</a>
    </div>
  </nav>
</header>
