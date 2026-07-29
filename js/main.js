/* ==========================================================================
   KAIK HOME — JS PRINCIPAL (vanilla, sin dependencias)
   Funciones: menú móvil, smooth scroll de anclas, envío de formularios
   por fetch y sustitución del video por embed cuando hay URL disponible.
   ========================================================================== */

(function () {
  'use strict';

  /* ---------- Menú móvil ---------- */
  var toggle = document.querySelector('.menu-toggle');
  var mobileNav = document.querySelector('.mobile-nav');

  if (toggle && mobileNav) {
    toggle.addEventListener('click', function () {
      var isOpen = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    /* Cerrar el menú al elegir una opción */
    mobileNav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- Animaciones sutiles al hacer scroll (.reveal) ---------- */
  var revealTargets = document.querySelectorAll('.reveal');
  var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (revealTargets.length) {
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
      revealTargets.forEach(function (el) { el.classList.add('is-visible'); });
    } else {
      var revealObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

      revealTargets.forEach(function (el) { revealObserver.observe(el); });
    }
  }

  /* ---------- Smooth scroll para anclas internas ---------- */
  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var id = link.getAttribute('href');
      if (id.length > 1) {
        var target = document.querySelector(id);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });

  /* ---------- Video / tour virtual: reemplaza la imagen por un iframe si hay URL ---------- */
  document.querySelectorAll('[data-video-url]').forEach(function (frame) {
    var url = frame.getAttribute('data-video-url');
    if (url && url.trim() !== '') {
      var iframe = document.createElement('iframe');
      iframe.src = url;
      iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
      iframe.setAttribute('allowfullscreen', '');
      iframe.setAttribute('title', 'Tour virtual');
      frame.innerHTML = '';
      frame.appendChild(iframe);
    } else {
      /* Sin URL todavía: el botón play no hace nada más que indicar que el video está pendiente */
      var playBtn = frame.querySelector('.play-btn');
      if (playBtn) {
        playBtn.addEventListener('click', function () {
          alert('El video estará disponible próximamente.');
        });
      }
    }
  });

  /* ---------- Carrusel de planos (tipologías con más de un plano) ---------- */
  document.querySelectorAll('.planos-carousel').forEach(function (carousel) {
    var slides = carousel.querySelectorAll('.planos-carousel-slide');
    var dots = carousel.querySelectorAll('.planos-carousel-dot');
    var prevBtn = carousel.querySelector('.planos-carousel-prev');
    var nextBtn = carousel.querySelector('.planos-carousel-next');
    var current = 0;

    var goTo = function (index) {
      current = (index + slides.length) % slides.length;
      slides.forEach(function (slide, i) { slide.classList.toggle('is-active', i === current); });
      dots.forEach(function (dot, i) { dot.classList.toggle('is-active', i === current); });
    };

    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(current - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(current + 1); });
    dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () { goTo(i); });
    });

    /* Reinicia al primer plano cada vez que se abre el overlay que lo contiene */
    carousel.resetToFirst = function () { goTo(0); };
  });

  /* ---------- "Ver planos": amplía la card de la tipología y muestra sus planos ---------- */
  document.querySelectorAll('.planos-trigger').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var overlay = document.getElementById(btn.getAttribute('data-planos'));
      if (!overlay) return;
      var carousel = overlay.querySelector('.planos-carousel');
      if (carousel && carousel.resetToFirst) carousel.resetToFirst();
      overlay.hidden = false;
      document.body.classList.add('no-scroll');
      requestAnimationFrame(function () { overlay.classList.add('is-open'); });
    });
  });

  document.querySelectorAll('.planos-overlay').forEach(function (overlay) {
    var closeOverlay = function () {
      overlay.classList.remove('is-open');
      document.body.classList.remove('no-scroll');
      window.setTimeout(function () { overlay.hidden = true; }, 300);
    };
    var closeBtn = overlay.querySelector('.planos-close');
    if (closeBtn) closeBtn.addEventListener('click', closeOverlay);
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeOverlay();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeOverlay();
    });
  });

  /* ---------- Envío de formularios de contacto por fetch ---------- */
  document.querySelectorAll('.contact-form').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var msgBox = form.querySelector('.form-msg');
      var submitBtn = form.querySelector('button[type="submit"]');
      var originalBtnText = submitBtn ? submitBtn.innerHTML : '';

      /* Honeypot anti-spam: si el campo oculto tiene valor, no se envía (probable bot) */
      var honeypot = form.querySelector('input[name="website"]');
      if (honeypot && honeypot.value !== '') {
        return;
      }

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Enviando...';
      }

      var formData = new FormData(form);

      fetch('php/contact.php', {
        method: 'POST',
        body: formData
      })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          if (msgBox) {
            msgBox.textContent = data.message || (data.success ? 'Mensaje enviado correctamente.' : 'Ocurrió un error. Intenta nuevamente.');
            msgBox.classList.remove('is-success', 'is-error');
            msgBox.classList.add(data.success ? 'is-success' : 'is-error', 'is-visible');
          }
          if (data.success) {
            form.reset();
          }
        })
        .catch(function () {
          if (msgBox) {
            msgBox.textContent = 'No se pudo enviar el mensaje. Comprueba tu conexión e inténtalo de nuevo.';
            msgBox.classList.remove('is-success');
            msgBox.classList.add('is-error', 'is-visible');
          }
        })
        .finally(function () {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
          }
        });
    });
  });
})();
