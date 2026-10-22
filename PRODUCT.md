# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

Migrating from plain PHP MVC to Astro (static output in `dist/`) with a PHP endpoint kept only for the contact form (PHPMailer + SMTP). Hosting is shared cPanel + CloudLinux + LiteSpeed (PHP, FTP, free SSL, 1.2 GB RAM, unlimited subdomains); no Node at runtime, builds happen locally or in GitHub Actions and deploy by FTP. A git-based content editor (Keystatic or Decap) is a planned future phase, so content must live as structured data, not hard-coded markup.

## Users

- **Families buying a home**: local buyers and Madrid commuters looking for a new-build home in Toledo province to live in. They compare developments, layouts (m², bedrooms, patios), delivery dates and location, then ask for a visit or the dossier.
- **Investors**: buyers purchasing new-build units as an investment; they care about price, location, delivery timing and construction progress.
- **Owners who want to sell**: property owners looking for someone to sell their home (the contact form's "Quiero vender mi propiedad").

## Product Purpose

Kaik Home is a real-estate promoter in Toledo (Spain) that develops and builds residential projects. The site presents its active developments, announces upcoming ones, and turns visitors into contacts: visit requests, dossier downloads, and enquiries routed to the right inbox. Success is a qualified lead (call, email or form) per development, plus sellers reaching out.

## Positioning

- **Promotes and builds**: Kaik Home both develops and constructs its projects, so the buyer deals with one accountable party from plot to keys.
- **Close, local service**: a Toledo team with 10+ years of local experience; direct contact with the people building the home and visits to the site with the technicians.
- **Transparency on the build**: visible construction progress, clear delivery dates, quality you can check on site.
- **Price and location**: design homes at accessible prices, near Toledo capital and within reach of Madrid.

## Operating Context

- Active developments: **Diana Residencial** (Bargas, Toledo): 37 homes, one- and two-storey types, new build under construction, delivery Q2 2027. **Vista Residencial Méntrida** (Méntrida, Toledo; comarca de Torrijos): 24 two-storey homes, 60% of works executed, delivery Q1 2027.
- Upcoming developments ("Próximamente"): detached chalet in Los Ángeles de San Rafael; multi-family housing in Parla; single-family home in Casarrubios del Monte.
- Each development offers house types with floor plans (lightbox), a downloadable PDF dossier, a virtual/house tour video slot, and a visit-request form.
- Contact: Puerta de la Fuente 13, Ocaña 45300 · +34 687 45 92 16 · comercial@kaikhome.com. Form submissions carry an `origen` field that routes to the general, Bargas or Méntrida inbox.
- Tracking via Google Tag Manager (GTM-WC5FL2PP). Public URLs `/`, `/bargas`, `/mentrida` must be kept for SEO, with 301s from the old `*.html` URLs.

## Capabilities and Constraints

- All figures shown (homes per development, m², bedrooms, bathrooms, patios, delivery quarters, % of works) are real and current; future work must not round, invent or embellish them.
- Copy is Spanish from Spain (es_ES) using "tú". Argentine voseo ("Reservá") is an error to fix.
- Content (developments, house types, upcoming projects) must be data-driven so a non-developer can edit it in a later phase.
- Undecided: which content editor (Keystatic or Decap); exact domain cutover date.

## Brand Commitments

- Name: Kaik Home. Existing logo files: `img/logo.png` (header), `img/logo-footer.png`, `img/favicon.png`. The logo and its brand green (`#558f6e`) are kept through the redesign; everything else visual may change.
- The redesign must not read as a generic promoter template, nor as playful or unserious; motion must be modern but never excessive or slow on mobile.
- RE/MAX and Seneas are **not** to appear on the site; their logos (`img/logo-remax.png`, `img/logo-seneas.png`) must be removed.
- Voice: close, honest and professional; family-oriented ("guiamos familias hacia sus nuevos comienzos"), without real-estate hype.

## Evidence on Hand

- Architectural **renders** (not photos) for each development, hero and house type: `img/hero-*.jpg`, `img/card-*.jpg`, `img/*-tipo*.jpg`; floor plans `img/*-planos*.jpg`. Source files are 2–5 MB and need optimisation.
- PDF dossiers: `pdf/diana-residencial-dossier.pdf`, `pdf/residencial-mentrida-dossier.pdf`.
- No testimonials, client counts, awards or press exist. Do not fabricate them. Real construction-progress photos do not exist yet; renders must not be presented as photographs of finished homes.

## Product Principles

1. **Real numbers over adjectives**: m², delivery dates and progress % are the strongest persuasion; lead with them.
2. **One accountable builder**: make "we promote and build" felt throughout, not as a slogan block.
3. **Always one step from a person**: phone, visit and form are reachable from every development page.
4. **Show the build honestly**: renders labelled as renders; progress shown as it really is.
5. **Content as data**: every development and house type is an entry, ready for a future editor.

## Accessibility & Inclusion

Target WCAG 2.2 AA. All motion (scroll effects, banner transitions, hover) must respect `prefers-reduced-motion` and the site must stay usable without JavaScript. Sliders and lightbox must be keyboard operable.
