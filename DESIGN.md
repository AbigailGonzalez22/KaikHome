---
name: Kaik Home
description: Promotora y constructora de obra nueva en la provincia de Toledo; sitio público de promociones.
colors:
  brand-green: "#558f6e"
  brand-green-button: "#487a5e"
  brand-green-button-hover: "#3d6b51"
  brand-green-ink: "#3e7356"
  mint: "#9af7af"
  clay: "#e2725b"
  clay-button: "#b8513b"
  ink: "#1b1c1c"
  ink-soft: "#3f4940"
  white: "#ffffff"
  paper: "#f5f3f3"
  paper-2: "#efeded"
  paper-3: "#f8f9f8"
  line: "#becabd"
  charcoal: "#2c3333"
  forest-footer: "#25352c"
typography:
  display:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif"
    fontSize: "clamp(34px, 1.6rem + 2.6vw, 56px)"
    fontWeight: 800
    lineHeight: 1.08
    letterSpacing: "-0.025em"
  headline:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', sans-serif"
    fontSize: "clamp(26px, 1.2rem + 1.6vw, 40px)"
    fontWeight: 800
    lineHeight: 1.15
    letterSpacing: "-0.015em"
  title:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', sans-serif"
    fontSize: "22px"
    fontWeight: 800
    lineHeight: 1.3
  body-lead:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', sans-serif"
    fontSize: "18px"
    fontWeight: 400
    lineHeight: 1.5
  body:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', sans-serif"
    fontSize: "15px"
    fontWeight: 400
    lineHeight: 1.5
  label:
    fontFamily: "'Plus Jakarta Sans Variable', 'Plus Jakarta Sans', sans-serif"
    fontSize: "14px"
    fontWeight: 700
    lineHeight: 1.2
rounded:
  md: "20px"
  lg: "32px"
  pill: "9999px"
spacing:
  gutter: "24px"
  card-gap: "28px"
  section-head: "48px"
  section: "clamp(56px, 4rem + 3vw, 104px)"
  container: "1180px"
components:
  button-primary:
    backgroundColor: "{colors.brand-green-button}"
    textColor: "{colors.white}"
    typography: "{typography.label}"
    rounded: "{rounded.pill}"
    padding: "15px 28px"
  button-primary-hover:
    backgroundColor: "{colors.brand-green-button-hover}"
  button-outline:
    backgroundColor: "transparent"
    textColor: "{colors.brand-green-ink}"
    rounded: "{rounded.pill}"
    padding: "15px 28px"
  button-outline-hover:
    backgroundColor: "{colors.brand-green-button}"
    textColor: "{colors.white}"
  button-clay:
    backgroundColor: "{colors.clay-button}"
    textColor: "{colors.white}"
    rounded: "{rounded.pill}"
    padding: "15px 28px"
  badge-mint:
    backgroundColor: "{colors.mint}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.pill}"
    padding: "10px 20px"
  chip:
    backgroundColor: "{colors.paper-2}"
    textColor: "{colors.ink-soft}"
    rounded: "{rounded.pill}"
    padding: "8px 16px"
  card-tipologia:
    backgroundColor: "{colors.white}"
    rounded: "{rounded.lg}"
    padding: "28px"
  input-field:
    backgroundColor: "{colors.white}"
    textColor: "{colors.ink}"
    padding: "13px 16px"
  contact-panel-info:
    backgroundColor: "{colors.charcoal}"
    textColor: "{colors.white}"
    padding: "56px 48px"
  footer:
    backgroundColor: "{colors.forest-footer}"
    textColor: "{colors.white}"
---

# Design System: Kaik Home

## Overview

**Creative North Star: "La casa a la vista"**

Kaik Home sells homes that are still being built, so the system keeps the building in view and gets everything else out of its way. Real renders and photographs of Toledo fill large, softly rounded frames. One confident green says "this is us, act here." The rest is white and near-white paper, dark ink and generous air. The tone is friendly and local, the sort of developer that answers the phone, and it never reads as luxury or as a corporate portal.

This build refines the incumbent identity of the original PHP site (`legacy/css/styles.css`). Typeface, palette, pill badges, 32px cards, the dark contact panel and the forest footer all carry over unchanged. The modernization layer is motion only: a self-hosted variable font, a staggered hero entrance, fade-up reveals, Lenis smooth scrolling, a crossfading and pushing-in home hero, Ken Burns and parallax on development heroes, a header that compacts, cards that lift, a shine sweep across buttons, pulsing status dots, and a view transition from a development card into its hero. Every motion has a reduced-motion fallback, and content never depends on JavaScript to become visible.

Density is low to medium. A page is a series of full-width bands that alternate white with paper. Each band has a single left-aligned section head, then a two- or three-up grid of large cards.

**Key Characteristics:**
- Plus Jakarta Sans throughout, extra-bold (800) headings with tight tracking, regular body in a soft green-grey ink.
- One brand green carries every action; mint and clay appear only as status and highlight.
- Large 32px-radius image cards with soft, wide, low-opacity shadows that deepen on hover.
- Pill shapes for every button, badge, chip and status marker.
- A dark charcoal contact panel with a drifting mint glow sits opposite a light form; a deep forest-green footer closes the page.
- Motion is eased with one curve (`cubic-bezier(0.22, 1, 0.36, 1)`) and always degrades to static.

## Colors

The palette is a single muted garden green on warm-neutral paper, with a cool mint highlight and a terracotta clay for "obra en curso" status.

### Primary
- **Kaik Garden Green** (brand-green): the brand voice. Used for links, the nav underline, focus outlines (3px, 2px offset), outline-button borders, check icons, icon tints, active carousel dots, `accent-color`, and the green half of the hero headline ("Kaik Home").
- **Button Green** (brand-green-button): the fill behind white text on primary buttons, card CTAs and the FAB hover state. It is darker than the brand green so it passes AA. Its hover state is **Deep Button Green** (brand-green-button-hover).
- **Green Ink** (brand-green-ink): green used as small text on white, such as active nav items, outline-button labels, badge text on tipología cards, the "Ver en grande" link and the floating hero badge figure.

### Secondary
- **Mint Glow** (mint): pill badges ("Próximamente") with a 1px ink border, text selection, contact-panel labels and icons, the radial glow on the dark panel, and hover fills for footer social circles. On dark grounds it sits behind or as text; on light grounds it appears only as a badge fill or an 18% icon-circle tint.

### Tertiary
- **Clay** (clay): the "obra en curso" status dot with its pulse, plus error-state tints (15% focus ring, 12% message background).
- **Burnt Clay** (clay-button): the clay fill behind white text, used for the clay button and the "obra en curso" status pill on development heroes.

### Neutral
- **Ink** (ink): body text and headings, the mint badge border, and the base of every shadow and scrim (`rgb(27 28 28 / x)`).
- **Soft Ink** (ink-soft): secondary copy, nav links at rest, chip text, form hints.
- **White** (white): the default page ground, card bodies, form fields and the dialog surface.
- **Paper** (paper), **Paper 2** (paper-2), **Paper 3** (paper-3): alternating band grounds. Paper sits behind "Somos Kaik Home" and tipologías, Paper 2 behind chips, the trust strip, dropdown hover and dialog image wells, and Paper 3 behind the promotions-upcoming band and the contact section and form.
- **Sage Line** (line): input borders, inactive carousel dots and the hover state of the dialog close button.
- **Charcoal** (charcoal): the contact info panel, the FAB, the skip link.
- **Forest Footer** (forest-footer): the footer ground. Footer text sits at white 60–80% opacity, and links turn mint on hover.

### Named Rules
**The Two-Greens Rule.** White text never sits on Kaik Garden Green. It sits on Button Green (or Deep Button Green on hover). Small green text on white uses Green Ink. Kaik Garden Green itself is for strokes, icons, focus and large display words.

**The Status-Only Accents Rule.** Mint and clay are for status and highlight (badges, dots, labels, glow, selection). Never use them as a primary action color. Clay exists for "obra en curso" and for errors.

## Typography

**Display Font:** Plus Jakarta Sans Variable, self-hosted via `@fontsource-variable`, with fallbacks -apple-system, BlinkMacSystemFont, Segoe UI and sans-serif
**Body Font:** the same family
**Label/Mono Font:** none; labels use the same family at weight 700

**Character:** A single geometric-humanist sans covers every role. It sets heavy and tight in headings and turns open and friendly at regular weight. Hierarchy comes from weight (800 / 700 / 600 / 400) and size, with no second face.

### Hierarchy
- **Display** (800, clamp 34–56px, 1.08, -0.025em): page h1 only, on the home hero, development heroes and the 404 page (clamp 32–52/56px). Balanced wrapping (`text-wrap: balance`).
- **Headline** (800, clamp 26–40px, 1.15, -0.015em): section h2s. The contact panel h2 tops out at 32px and the "Somos" h2 at 36px.
- **Title** (800, 22px): tipología card h3 and dialog h2. Promotion card titles are 28px (-0.01em) on available cards and 20px/1.3 on upcoming cards.
- **Body lead** (400, 18px; 17px under section heads and on development heroes): intro copy capped at about 46ch on the home hero and 620px on development heroes.
- **Body** (400, 15px, 1.5): card copy, check lists, contact details, footer columns (14px).
- **Label** (700, 14–15px): buttons (15px), badges and chips (14px; chips use 600), nav links (600, 15px), form labels (700, 14px). Uppercase appears only on contact-detail labels (13px, 0.04em, mint on charcoal) and the trust-strip label (12px, 0.08em).

### Named Rules
**The Weight-Not-Face Rule.** Hierarchy comes from Plus Jakarta Sans weight and size. Headings are 800 with negative tracking. Never introduce a second display face or a serif.

## Layout

- **Container:** max 1180px, centered, with 24px side padding.
- **Sections:** full-width bands with vertical padding of `clamp(56px, 4rem + 3vw, 104px)`, alternating white with Paper or Paper 3. The section head is left-aligned, max 640px wide, with 48px below it.
- **Grids:** promotion and tipología cards use two equal columns with a 28px gap, and upcoming promotions use three. Everything collapses to one column at ≤1024px. A single tipología centers at max 760px.
- **Home hero:** a 1:1 copy/media grid with a 56px gap. At ≤1024px it stacks with the media first.
- **Development hero:** a full-bleed image under a bottom-heavy black scrim, with content anchored to the bottom (min-height `min(760px, 100svh − header)`). A four-column glass stat bar becomes two columns at ≤760px.
- **Contact panel:** a 1fr / 1.1fr split of dark info and light form, stacking at ≤1024px. Inner padding is 56px 48px, dropping to 36px 24px at ≤640px.
- **Footer:** 1.4fr / 1fr / 1fr / 1.2fr columns with a 40px gap. It becomes two columns at ≤1024px and one at ≤640px.
- **Header:** sticky, 84px tall, compacting to 68px after 24px of scroll. Nav collapses to a menu toggle at ≤900px, and the header CTA hides at ≤480px.
- **Breakpoints in use:** 1024px, 900px, 760px, 640px, 480px.

## Elevation & Depth

Depth is a hybrid. Surfaces at rest float on soft, wide, low-opacity ink shadows. Hover deepens a shadow and lifts the element, and glass (backdrop blur) separates overlays from photography. Shadow color is always ink (`rgb(27 28 28)`), never black and never colored.

### Shadow Vocabulary
- **Soft** (`0 20px 60px rgb(27 28 28 / 0.1)`): resting cards, the floating hero badge, carousel arrows.
- **Strong** (`0 30px 80px rgb(27 28 28 / 0.22)`): hovered cards, the hero image frame, the contact panel, the plan dialog, the nav dropdown, the FAB.
- **Button lift** (`0 12px 24px rgb(27 28 28 / 0.15)`): button hover, with a -2px lift.
- **Header scrolled** (`0 8px 30px rgb(27 28 28 / 0.08)`): the sticky header once compacted.
- **Glass:** white at 82–92% with 10–14px blur (badges on photos, floating hero badge), white at 10% with 16px blur and a white 20% border (development stat bar), and white at 85–94% with 12px blur (header).

### Named Rules
**The Lift-On-Hover Rule.** Interactive cards rest on Soft and, on hover, rise 6px to Strong while the image inside zooms slowly (1.05–1.06 over 0.7s). Buttons rise 2px. Nothing lifts without being clickable.

## Shapes

Shapes are rounded and friendly throughout, with no sharp corners on any surface.
- **Large (32px):** cards, the hero image frame, the contact panel, the plan dialog, the development stat bar.
- **Medium (20px):** the floating hero badge and the plan image well.
- **Pill (9999px):** every button, badge, chip, status pill, the FAB and the skip link.
- **Circle:** icon circles (40px), footer social buttons (38px), the dialog close button (40px), carousel arrows (44px), status dots (9px).
- Carousel and slideshow dots stretch from a circle into a short pill when active (8–9px growing to 22–24px).
- Line icons are drawn on a 24px grid with a 2px rounded stroke (Icon component), never as glyph or emoji icons.

## Components

### Buttons
Buttons are tactile and confident. They are pill-shaped, bold, and carry a shine sweep.
- **Shape:** pill (9999px) with a 2px border (transparent unless outlined), 15px 28px padding, 700 weight at 15px, and an 8px icon gap.
- **Primary:** Button Green fill with white text, turning Deep Button Green on hover.
- **Outline:** transparent with a Kaik Garden Green border and Green Ink text. On hover it fills with Button Green and the text turns white.
- **Clay:** Burnt Clay fill with white text, reserved for clay-status contexts.
- **Ghost white:** white at 12% with a 50% white border, white text and 8px blur. It sits over photography and goes to 22% on hover.
- **Hover / Active:** the button lifts 2px with the button-lift shadow while a diagonal white 25% shine sweeps across in 0.6s. Arrow icons nudge 3px right and down icons 2px down. Active presses to `scale(0.97)`. Disabled sits at 60% opacity with a progress cursor.
- **Card CTA (promo-btn):** a smaller Button Green pill (12px 22px, 14px) whose gap widens from 8 to 12px on card hover.

### Badges & Chips
- **Mint badge:** Mint fill, a 1px ink border and ink text in a 14px/700 pill (10px 20px), with an optional 16px leading icon. Use it for "Próximamente" and similar highlights.
- **White badge:** white at 90% with 10px blur. It carries a status dot (clay or green, 9px, pulsing ring on a 2.4s loop) or m² figures over images.
- **Status pill:** 13px 22px at 15px/700. Clay status uses a Burnt Clay fill. Green status uses white 12% with a 2px white 50% border over the dark hero.
- **Chip:** Paper 2 fill with Soft Ink text, 14px/600 and 8px 16px padding, for tipología facts.

### Cards / Containers
- **Promotion card:** a full-bleed image (height clamp 340–440px, or 360px for upcoming) under a bottom black scrim (75% fading to 0). The white title, copy and card CTA are anchored bottom with 32px padding (24px on mobile). A status badge sits top-left at 20px. The image carries a view-transition name into the development hero.
- **Tipología card:** a white card with a 32px radius and Soft shadow. The image well (clamp 260–360px) carries white badges bottom-left, and the body has 28px padding with the CTA pushed to the bottom.
- **Hover:** see the Lift-On-Hover Rule.
- **Icon circle:** 40px circle with an 18% Mint tint and a green icon, used in the floating badge and contact details (16% mint tint with a mint icon on charcoal).

### Inputs / Fields
- **Style:** white field with a 1px Sage Line border, a 14px radius and 13px 16px padding. The label above is 14px/700, and optional hints are 500 weight in Soft Ink.
- **Hover:** the border turns Kaik Garden Green.
- **Focus:** a Kaik Garden Green border plus a 4px green ring at 18%, with no outline.
- **Error:** a clay-red border with a 4px clay ring at 15%. The 13px/600 error text sits below, linked via `aria-describedby`.
- **Form message:** a 12px-radius block, green 12% for success and clay 12% for error.

### Navigation
- **Desktop:** a sticky white-glass header with the logo (36px), centered nav links (600, 15px, Soft Ink, 36px gap), social icons in green, and a primary "Contactar" pill. Hover and the current page turn the link Green Ink and grow a 2px green underline from the center (`scaleX`).
- **Dropdown:** "Promociones" opens a white 16px-radius menu with the Strong shadow on hover or click. Its items are 10px-radius rows that fill with Paper 2 on hover or when current.
- **Mobile (≤900px):** a menu toggle opens a full-width white sheet (slide-in 0.35s) with 17px links on hairline separators and a two-up action grid.

### Contact Panel (signature)
A 32px-radius split panel with the Strong shadow. The left side is Charcoal with white text, mint uppercase labels and mint icon circles that fill solid mint on hover. A 420px radial mint glow (35%) drifts in the top-right corner on a 14s alternate loop. The right side is a Paper 3 form. It appears on every page.

### Plan Dialog
A native `<dialog>` up to 860px wide with a 32px radius, the Strong shadow and a 60% ink backdrop with 4px blur. It scales in from 0.94. Plans are contained in a 20px-radius Paper 2 well. Navigation uses round white arrows (44px), stretch dots and a "Ver en grande" Green Ink link. The circular close button rotates 90° on hover.

### FAB
On development pages, a Charcoal pill ("Quiero más info") with the Strong shadow slides up once the hero is passed and hides while the contact section is in view. On hover it turns Button Green and lifts 2px.

### Footer
A Forest Footer ground holding four columns with 15px/700 white headings and 14px links at white 70% that turn mint on hover. Social icons sit in 38px outlined circles that fill mint. A hairline separates the 13px legal row.

## Do's and Don'ts

### Do:
- **Do** put white text only on Button Green (#487a5e), Deep Button Green (#3d6b51), Burnt Clay (#b8513b), Charcoal or Forest Footer. Use Green Ink (#3e7356) for small green text on white.
- **Do** use the 32px radius for every card-scale surface and the pill radius for every button, badge and chip.
- **Do** keep shadows ink-tinted and wide: Soft at rest, Strong on hover or for overlays.
- **Do** ease all motion with `cubic-bezier(0.22, 1, 0.36, 1)`. Keep content visible without JS (`html.js .reveal`) and switch motion off under `prefers-reduced-motion`.
- **Do** alternate white and paper bands, with one left-aligned section head (max 640px) per band.
- **Do** draw icons as 2px-stroke line SVGs on a 24px grid.

### Don't:
- **Don't** put white text on Kaik Garden Green (#558f6e) or on Clay (#e2725b). Neither passes AA at button sizes.
- **Don't** use mint or clay as an action color. They mark status and highlight only.
- **Don't** add a second typeface or drop headings below weight 800.
- **Don't** use black or colored shadows, or hard offset shadows.
- **Don't** use sharp corners on cards, buttons or fields.
