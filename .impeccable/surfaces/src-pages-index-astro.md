---
version: 1
slug: "src-pages-index-astro"
primary_target: "src/pages/index.astro"
related_targets: ["src/pages/[slug].astro"]
---

# Kaik Home — sitio público (home + páginas de promoción)

Scope: home (`src/pages/index.astro`) and development pages (`src/pages/[slug].astro`). Visitor mode: Persuade.

Audience and action: families and investors comparing new-build homes in Toledo province, plus owners who want to sell. Actions: reserve a visit, download the dossier, contact. Proof: real figures, renders, floor plans, "promueve y construye".

## Direction (refinement of the incumbent site)

The user asked for a version structurally like the existing PHP site, slightly modernized, with some effects but little change. This is a refinement, not a new world: keep the incumbent identity from `legacy/` (Plus Jakarta Sans, brand green #558f6e, mint #9af7af pill badges, clay #e2725b for "obra en curso", 32px rounded cards with soft shadows, white/paper grounds, dark #2c3333 contact panel with mint glow, #25352c footer), the same sections in the same order and the same copy (tú, no voseo).

Modernizations allowed: self-hosted font, optimized responsive images, home hero image crossfade with slow push-in, staggered hero entrance, fade-up reveals on scroll, smooth scroll (Lenis), gentle parallax + Ken Burns on development heroes, header that compacts on scroll, card hover lift/zoom, view transition from development card to its hero, pulsing status dots, button shine. All motion respects reduced motion; content visible without JS.

The previous "Monografía de arquitectura" direction (seed:e62b82bf44a4bf17) is preserved on git branch `diseno-monografia` and no longer applies to main.
