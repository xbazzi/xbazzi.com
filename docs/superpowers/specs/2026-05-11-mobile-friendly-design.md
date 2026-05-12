# Mobile-Friendly Design

**Date:** 2026-05-11  
**Approach:** Tailwind responsive prefixes (Option A)

## Problem

The site uses a fixed 12-column CSS grid with no responsive breakpoints. On mobile:
- The 8/4 column split squishes all content into unreadable narrow columns
- The inner `grid-cols-4` card grids overflow or produce tiny unclickable cards
- Card `w-40` fixed width breaks in narrow containers
- Body vertical padding wastes screen space on phones
- Post images can cause horizontal scroll on small screens

## Decisions

- Sidebar stacks **below** main content on mobile (DOM order already correct)
- Cards: **2 per row** on mobile, 4 on desktop
- Desktop layout preserved; minor polish allowed

## Changes

### 1. `source/index.blade.php` — outer grid

```diff
- <div class="grid gap-4 grid-cols-12 max-w-5xl mx-auto">
+ <div class="grid gap-4 grid-cols-1 lg:grid-cols-12 max-w-5xl mx-auto">

- <div class="col-span-8 flex flex-col gap-8">
+ <div class="col-span-1 lg:col-span-8 flex flex-col gap-8">

- <div class="col-span-4 flex flex-col gap-8">
+ <div class="col-span-1 lg:col-span-4 flex flex-col gap-8">
```

### 2. `source/index.blade.php` — card grids (projects + blog)

```diff
- <div class="grid grid-cols-4 gap-4">
+ <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
```

Applied to both the projects section and the blog section.

### 3. `source/_partials/card.blade.php` — card dimensions

```diff
- class="block w-40 h-56 transition-all ...
+ class="block w-full h-40 sm:h-56 transition-all ...
```

`w-full` lets the grid cell control width. `h-40` on mobile, `h-56` restored at `sm` breakpoint.

### 4. `source/_layouts/main.blade.php` — body padding

```diff
- <body class="text-gray-900 py-10 antialiased">
+ <body class="text-gray-900 py-4 sm:py-10 antialiased">
```

Reduces top/bottom padding on phones; desktop unchanged.

### 5. `source/_layouts/post.blade.php` — image max-width

```diff
- <div class="my-4 mx-auto prose prose-invert prose-img:max-w-lg prose-img:mx-auto">
+ <div class="my-4 mx-auto prose prose-invert prose-img:max-w-full prose-img:mx-auto">
```

Prevents horizontal scroll from oversized images on narrow screens.

## Out of Scope

- Navigation/hamburger menu (no nav exists; sidebar just stacks)
- Dark/light mode
- Touch-specific gestures beyond what already works
- Any changes to the brick background, terminal window aesthetic, or color scheme
