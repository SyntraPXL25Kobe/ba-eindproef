# 🚀 Setup Guide

Een stap-voor-stap handleiding om de applicatie lokaal op te zetten. De stack bestaat uit **Laravel** (backend), **React** (frontend), **Inertia.js** (SPA-brug) en **Wayfinder** (type-safe route-helpers).

---

## Vereisten

Zorg dat de volgende tools geïnstalleerd zijn voordat je begint:

| Tool     | Minimale versie | Controleer met  |
| -------- | --------------- | --------------- |
| PHP      | 8.2+            | `php -v`        |
| Composer | 2.x             | `composer -V`   |
| Node.js  | 20+             | `node -v`       |
| npm      | 10+             | `npm -v`        |
| Git      | -               | `git --version` |

> **Optioneel maar aanbevolen:** [Laravel Herd](https://herd.laravel.com/) (macOS/Windows) of een lokale MySQL/PostgreSQL instantie.

---

## Stap 1 — Repository klonen

```bash
git clone https://github.com/<jouw-gebruikersnaam>/<repo-naam>.git
cd <repo-naam>
```

---

## Stap 2 — PHP-afhankelijkheden installeren

```bash
composer install
```

---

## Stap 3 — Omgevingsbestand aanmaken

Kopieer het voorbeeldbestand en pas de waarden aan:

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` en stel minstens de volgende variabelen in:

```dotenv
APP_NAME="Jouw App Naam"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jouw_database
DB_USERNAME=root
DB_PASSWORD=
```

---

## Stap 4 — Database aanmaken & migraties uitvoeren

Maak een lege database aan in MySQL/PostgreSQL, of gebruik SQLite:

```bash
# SQLite (eenvoudigst voor lokale ontwikkeling)
touch database/database.sqlite
# Zet in .env: DB_CONNECTION=sqlite

# Daarna migraties + seeders uitvoeren
php artisan migrate --seed
```

---

## Stap 5 — JavaScript-afhankelijkheden installeren

```bash
npm install
```

---

## Stap 6 — Wayfinder types genereren

[Wayfinder](https://github.com/laravel/wayfinder) genereert type-safe TypeScript-helpers op basis van jouw Laravel-routes en controllers. Voer dit uit na elke wijziging aan routes of controllers:

```bash
php artisan wayfinder:generate
```

De gegenereerde bestanden komen standaard terecht in `resources/js/actions/` en `resources/js/routes/`. Commit deze bestanden **mee** in Git zodat het team altijd gesynchroniseerde types heeft.

> **Tip:** Voeg het genereren toe aan een `post-autoload-dump` script in `composer.json` om het automatisch te laten draaien na `composer install`:
>
> ```json
> "scripts": {
>     "post-autoload-dump": [
>         "php artisan wayfinder:generate"
>     ]
> }
> ```

---

## Stap 7 — Assets bouwen

**Ontwikkeling** (met hot-reload via Vite):

```bash
npm run dev
```

**Productie** (geoptimaliseerde build):

```bash
npm run build
```

---

## Stap 8 — Lokale server starten

```bash
php artisan serve
```

De applicatie is nu bereikbaar op [http://localhost:8000](http://localhost:8000).

> Als je **Laravel Herd** gebruikt, sla dan stap 8 over. Herd registreert automatisch een `.test`-domein op basis van de mapnaam.

---

## Stap 9 — (Optioneel) Queue worker & scheduler starten

Sommige functionaliteit (mails, jobs) vereist een actieve queue worker:

```bash
php artisan queue:work
```

En voor de Laravel taakplanner:

```bash
php artisan schedule:work
```

---

## Veelgebruikte commando's

```bash
# Alle routes weergeven
php artisan route:list

# Caches legen
php artisan optimize:clear

# Wayfinder types opnieuw genereren
php artisan wayfinder:generate

# TypeScript-types controleren
npx tsc --noEmit

# Tests uitvoeren
php artisan test

# Frontend linting
npm run lint
```

---

## Projectstructuur (overzicht)

```
.
├── app/                    # Laravel applicatielogica (Models, Controllers, ...)
├── database/               # Migrations, seeders, factories
├── resources/
│   ├── js/
│   │   ├── actions/        # Gegenereerde Wayfinder controller-helpers (auto-generated)
│   │   ├── routes/         # Gegenereerde Wayfinder route-helpers (auto-generated)
│   │   ├── components/     # Herbruikbare React-componenten
│   │   ├── layouts/        # Inertia layout-wrappers
│   │   └── pages/          # Inertia page-componenten (gekoppeld aan Laravel views)
│   └── views/
│       └── app.blade.php   # Inertia root-template
├── routes/
│   ├── web.php             # Web-routes (Inertia-responses)
│   └── api.php             # API-routes (optioneel)
├── .env.example
├── vite.config.ts
└── tsconfig.json
```

---

## Veelvoorkomende problemen

**`php artisan wayfinder:generate` geeft een fout**
Controleer of Wayfinder correct is geïnstalleerd: `composer show laravel/wayfinder`. Installeer indien nodig met `composer require laravel/wayfinder`.

**Witte pagina / Inertia laadt niet**
Zorg dat `npm run dev` actief is in een apart terminalvenster en dat `APP_URL` in `.env` overeenkomt met de URL die je gebruikt.

**TypeScript-fouten na een route-wijziging**
Voer `php artisan wayfinder:generate` opnieuw uit om de types te synchroniseren.

**Database-verbindingsfout**
Controleer de `DB_*`-variabelen in `.env` en zorg dat de databaseserver actief is.

---

## Bijdragen

1. Maak een nieuwe branch aan: `git checkout -b feature/jouw-feature`
2. Commit je wijzigingen: `git commit -m "feat: beschrijving van de wijziging"`
3. Push naar de branch: `git push origin feature/jouw-feature`
4. Open een Pull Request

---

_Vragen of problemen? Open een [issue](https://github.com/<jouw-gebruikersnaam>/<repo-naam>/issues)._
