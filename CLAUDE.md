# Studiekeuze Platform

## Stack
- PHP 8.5 · Laravel 13 · Inertia Laravel v3 · Fortify v1 · Wayfinder v0 · Boost v2
- React 19 · TailwindCSS v4 · Inertia React v3
- PHPUnit v12 · Pint v1 · Sail v1 · Pail v1

## MVP Scope
**Rollen:** Gast · Student · Professional · Admin

**Kern:** Auth (email + Google OAuth) · Profielbeheer · Zoeken (studies/beroepen/professionals) · Favorieten · Connecties · Evenementen · Agenda · Chat · Notificaties · Reviews/Kudos · Rapporteren

**Niet in scope:** AI-matching · mobiele app · niet-Google OAuth · betaling · video/audio

## Conventies
- Volg bestaande code-conventies; check sibling files voor structuur en naamgeving.
- Beschrijvende namen (`isRegisteredForDiscounts`, niet `discount()`).
- Hergebruik bestaande componenten voor nieuwe aanmaken.
- Geen nieuwe basismappen of dependencies zonder goedkeuring.
- Geen documentatiebestanden tenzij expliciet gevraagd.
- Geen verificatiescripts; schrijf tests.

## PHP
- Altijd curly braces, ook bij één regel.
- Constructor property promotion; geen lege `__construct()`.
- Expliciete return types en type hints overal.
- TitleCase voor Enum keys.
- PHPDoc boven inline comments; array shape types in PHPDoc.

## Laravel
- Gebruik `php artisan make:` voor alle nieuwe bestanden (pass `--no-interaction`).
- Generieke PHP-klassen via `php artisan make:class`.
- Nieuwe modellen krijgen altijd een factory en seeder.
- Routes via named routes en `route()`-functie.
- APIs: Eloquent API Resources + versioning (tenzij bestaande conventie afwijkt).

## Inertia v3
- Components in `resources/js/pages`.
- Gebruik `Inertia::render()` i.p.v. Blade views.
- `Inertia::optional()` (niet meer `lazy()`); `router.cancelAll()` (niet meer `cancel()`).
- Deferred props krijgen skeleton/loading state.
- Events hernoemd: `invalid` → `httpException`, `exception` → `networkError`.

## Wayfinder
- Importeer vanuit `@/actions/` (controllers) of `@/routes/` (named routes).

## Vite
- Bij "Unable to locate file in Vite manifest": run `npm run build` of vraag `composer run dev`.
