// Site-wide motion, kept light and dependency-free apart from Lenis (smooth scroll):
// fade-up reveals as sections enter, a gentle parallax on development heroes and
// figures that count up. Content is never hidden without JS, and everything is
// skipped with reduced motion.
import Lenis from 'lenis';

const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;

// Reveals: .reveal elements fade up once when they enter the viewport.
const reveals = document.querySelectorAll<HTMLElement>('.reveal');
if (reduced || !('IntersectionObserver' in window)) {
  reveals.forEach((el) => el.classList.add('is-visible'));
} else {
  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    },
    { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
  );
  reveals.forEach((el) => io.observe(el));
}

if (!reduced) {
  // Smooth scroll.
  const lenis = new Lenis({ duration: 1.05, anchors: { offset: -80 }, autoRaf: true });
  document.addEventListener('kaik:lock', () => lenis.stop());
  document.addEventListener('kaik:unlock', () => lenis.start());

  // Parallax: the development hero image drifts a little slower than the page.
  const layers = Array.from(document.querySelectorAll<HTMLElement>('[data-parallax]'));
  if (layers.length) {
    const update = () => {
      layers.forEach((el) => {
        const box = el.parentElement!.getBoundingClientRect();
        if (box.bottom < 0 || box.top > innerHeight) return;
        const progress = Math.min(Math.max(-box.top / box.height, 0), 1);
        el.style.transform = `translate3d(0, ${progress * 14}%, 0)`;
      });
    };
    lenis.on('scroll', update);
    addEventListener('resize', update);
    update();
  }

  // Figures count up to their real value the first time they are seen.
  const counters = document.querySelectorAll<HTMLElement>('[data-count]');
  const countIo = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      countIo.unobserve(entry.target);
      const el = entry.target as HTMLElement;
      const target = Number(el.dataset.count);
      const start = performance.now() + 600;
      const duration = 1600;
      const tick = (now: number) => {
        const t = Math.min(Math.max((now - start) / duration, 0), 1);
        el.textContent = String(Math.round(target * (1 - Math.pow(1 - t, 3))));
        if (t < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  });
  counters.forEach((el) => countIo.observe(el));
}
