# Mobile-Friendly Layout Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make xbazzi.com render correctly on mobile by adding Tailwind responsive breakpoints to the grid layout, cards, body padding, and post images.

**Architecture:** Pure Tailwind class changes in Blade templates — no new components, no CSS additions, no JavaScript changes. Mobile-first: single column by default, desktop layout restored at `lg:` breakpoint. Cards fill grid cell width with `w-full`, grid controls columns.

**Tech Stack:** Tailwind CSS v3, Laravel Mix + Jigsaw static site generator, Blade templates. Build with `npm run dev` (outputs to `build_local/`). Verify visually in browser with DevTools mobile viewport (375px width / iPhone SE).

---

## File Map

| File | Change |
|------|--------|
| `source/index.blade.php` | Outer grid + both card grids |
| `source/_partials/card.blade.php` | Card dimensions |
| `source/_layouts/main.blade.php` | Body padding |
| `source/_layouts/post.blade.php` | Prose image max-width |

---

### Task 1: Fix the outer grid and sidebar column spans

**Files:**
- Modify: `source/index.blade.php`

- [ ] **Step 1: Update the outer grid container**

In `source/index.blade.php` line 4, change:
```html
<div class="grid gap-4 grid-cols-12 max-w-5xl mx-auto">
```
to:
```html
<div class="grid gap-4 grid-cols-1 lg:grid-cols-12 max-w-5xl mx-auto">
```

- [ ] **Step 2: Update the main content column span**

Line 5, change:
```html
<div class="col-span-8 flex flex-col gap-8">
```
to:
```html
<div class="col-span-1 lg:col-span-8 flex flex-col gap-8">
```

- [ ] **Step 3: Update the sidebar column span**

Line 48, change:
```html
<div class="col-span-4 flex flex-col gap-8">
```
to:
```html
<div class="col-span-1 lg:col-span-4 flex flex-col gap-8">
```

- [ ] **Step 4: Build and verify**

Run:
```bash
npm run dev
```
Open `build_local/index.html` in a browser. In DevTools, set viewport to 375px wide (iPhone SE). Expected: the "whoami", "projects", and "blog" windows stack full-width, and the links + RSS windows appear below them (not beside them). On desktop (1280px+), the original 2-column layout is restored.

---

### Task 2: Fix the card grids (projects + blog)

**Files:**
- Modify: `source/index.blade.php`

- [ ] **Step 1: Fix the projects card grid**

In `source/index.blade.php`, find the projects section (around line 24). Change:
```html
<div class="grid grid-cols-4 gap-4">
```
to:
```html
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
```

- [ ] **Step 2: Fix the blog card grid**

In the same file, find the blog section (around line 36). Change the identical line:
```html
<div class="grid grid-cols-4 gap-4">
```
to:
```html
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
```

- [ ] **Step 3: Build and verify**

Run:
```bash
npm run dev
```
Open `build_local/index.html` at 375px viewport. Expected: projects and blog cards display as 2 columns on mobile. On desktop they display as 4 columns.

---

### Task 3: Fix card component dimensions

**Files:**
- Modify: `source/_partials/card.blade.php`

- [ ] **Step 1: Replace fixed card dimensions with responsive ones**

In `source/_partials/card.blade.php` line 11, change:
```html
class="block 
        w-40 h-56 transition-all border border-black/60 rounded-md rounded-xs 
```
to:
```html
class="block 
        w-full h-40 sm:h-56 transition-all border border-black/60 rounded-md rounded-xs 
```

(`w-full` fills the grid cell. `h-40` = 160px on mobile, `h-56` = 224px restored at `sm` / 640px+.)

- [ ] **Step 2: Build and verify**

Run:
```bash
npm run dev
```
Open `build_local/index.html` at 375px viewport. Expected: cards fill the full width of each grid cell (no fixed 160px width). Card height is comfortable for touch (160px). On desktop: cards are slightly taller (224px) and fill their grid cells. Hover overlay and title text animation still work.

---

### Task 4: Fix body padding for mobile

**Files:**
- Modify: `source/_layouts/main.blade.php`

- [ ] **Step 1: Make body padding responsive**

In `source/_layouts/main.blade.php` line 23, change:
```html
<body class="text-gray-900 py-10 antialiased">
```
to:
```html
<body class="text-gray-900 py-4 sm:py-10 antialiased">
```

(`py-4` = 16px top/bottom on mobile, `py-10` = 40px restored at 640px+.)

- [ ] **Step 2: Build and verify**

Run:
```bash
npm run dev
```
Open `build_local/index.html` at 375px. Expected: logo has a smaller gap above/below it on mobile — more content fits above the fold. At desktop width the padding is unchanged.

---

### Task 5: Fix post image overflow on mobile

**Files:**
- Modify: `source/_layouts/post.blade.php`

- [ ] **Step 1: Remove fixed max-width on prose images**

In `source/_layouts/post.blade.php` line 7, change:
```html
<div class="my-4 mx-auto prose prose-invert prose-img:max-w-lg prose-img:mx-auto">
```
to:
```html
<div class="my-4 mx-auto prose prose-invert prose-img:max-w-full prose-img:mx-auto">
```

(`prose-img:max-w-lg` caps images at 512px. On a 375px screen that causes horizontal scroll. `max-w-full` keeps images within their container on any screen size.)

- [ ] **Step 2: Build and verify**

Run:
```bash
npm run dev
```
Open `build_local/blog/rvo/index.html` (or any post page) at 375px viewport. Expected: images stay within the page width and do not cause horizontal scrolling. On desktop, images still display up to their natural width.

---

### Task 6: Production build + final check

- [ ] **Step 1: Build production assets**

Run:
```bash
npm run prod
```
Expected: Mix compiles with `--production` flag (minified). Both `build_local/` and `build_production/` are updated.

- [ ] **Step 2: Final mobile check across pages**

Open each of these in a browser at 375px viewport and verify no horizontal scroll, no squished columns, no overflowing content:
- `build_local/index.html` — homepage
- `build_local/blog/rvo/index.html` — blog post
- `build_local/projects/datacenter/index.html` — project page

- [ ] **Step 3: Desktop regression check**

Set viewport to 1280px. Verify:
- Homepage: 8/4 column split is intact
- Projects + blog: 4 cards per row
- Terminal windows and info windows look identical to before
