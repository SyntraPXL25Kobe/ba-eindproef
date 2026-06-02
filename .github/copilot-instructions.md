# Project: Studiekeuze Platform — Copilot Instructions

## Wat is dit project?

Een full-stack webplatform dat jongeren helpt bij een realistische studie- en beroepskeuze via **micro-mentorship gesprekken** met professionals. De positionering: *"De brug tussen studie en praktijk."*

## MVP Scope (enkel dit bouwen)

Genereer **uitsluitend** code die past binnen de MVP-scope hieronder. Voeg geen extra features toe tenzij expliciet gevraagd.

### Gebruikersrollen

| Rol | Rechten |
|---|---|
| Gast | Studies, beroepen en evenementen bekijken |
| Student | Profiel, favorieten, professionals contacteren, evenementen volgen |
| Professional | Profiel, vragen beantwoorden, connecties, evenementen publiceren |
| Admin | Gebruikersbeheer, moderatie, statistieken, contentbeheer |

### Kernfunctionaliteiten

- Registratie & login (email + Google OAuth)
- Profielbeheer (student & professional)
- Interesses & studierichting (student)
- Zoeken naar studies, beroepen en professionals
- Detail­pagina's voor studies en beroepen
- Favorieten beheren
- Connectie­verzoeken (versturen / accepteren / weigeren)
- Evenementen bekijken, aanmaken (professional) en inschrijven (student)
- Persoonlijke agenda
- Chat (student ↔ professional)
- Notificaties (connecties, berichten, events)
- Review / Kudos systeem
- Gebruiker rapporteren
- Export persoonlijke gegevens (GDPR)

### Admin-paneel

- CRUD gebruikers, professionals, organisaties
- Studies, beroepen, sectoren beheren
- Evenementen modereren
- Rapportmeldingen verwerken
- Dashboard met statistieken
- Data exporteren (CSV)

## Database­modellen (MVP)

`users` · `profiles` · `studies` · `careers` · `sectors` · `events` · `event_registrations` · `connections` · `messages` · `reviews` · `notifications` · `reports`

## Werkverdeling (team van 3)

- **S1** — Backend, database, API, auth, rollen, GDPR
- **S2** — Frontend, zoek­pagina's, profielen, UI­componenten
- **S3** — Chat, events, notificaties, admin­panel

## Niet in scope (geen code voor genereren)

- AI-aanbevelingen / matching-algoritme
- Mobiele app (iOS/Android)
- OAuth buiten Google (LinkedIn, etc.)
- Betaalsysteem
- Uitgebreide analytics
- Video­/audio­gesprekken

## Coderichtlijnen

- Laravel 13 + PHP 8.5 + Inertia v3 + React 19 + Tailwind v4
- REST API met Eloquent Resources
- Policies voor autorisatie (geen gates tenzij eenvoudig)
- Feature tests voor elk API-endpoint (PHPUnit)
- Wayfinder voor type-safe route-verwijzingen vanuit React
- Pint draaien na elke PHP-wijziging (`vendor/bin/pint --dirty`)
- Geen inline comments tenzij uitzonderlijk complexe logica
