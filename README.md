# CMC Emplois

Application Laravel de gestion des emplois du temps pour CMC.

## Apercu

L application couvre 3 profils:

- Admin: gestion des filieres, groupes, salles, formateurs, seances.
- Formateur: consultation de son emploi, consultation des emplois groupe, contact admin.
- Stagiaire/Consultation: consultation publique des emplois par groupe.

Fonctionnalites importantes:

- Authentification multi-role.
- Reset mot de passe par OTP email.
- Interface multilingue (FR/EN/AR).
- Responsive mobile (dont iPhone).
- Export PDF des emplois depuis l interface.

## Stack Technique

- Backend: Laravel 12, PHP 8.2+
- Frontend: Blade, Tailwind, Vite
- Base de donnees: MySQL/MariaDB
- Outils: Composer, npm

## Installation

1. Cloner le projet:

```bash
git clone https://github.com/ANASS-AZYZ/CMC_emplois.git
cd CMC_emplois
```

2. Installer les dependances:

```bash
composer install
npm install
```

3. Configurer environnement:

```bash
cp .env.example .env
php artisan key:generate
```

4. Mettre a jour les variables DB dans .env:

- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

5. Initialiser la base:

```bash
php artisan migrate --seed
```

6. Lancer le projet:

```bash
php artisan serve
npm run dev
```

Application locale: http://127.0.0.1:8000

## Comptes De Test

- Admin
  - Email: admin@cmc.ma
  - Mot de passe: password123
- Formateur
  - Email: formateur@cmc.ma
  - Mot de passe: password123

## Commandes Utiles

```bash
php artisan migrate --seed
php artisan migrate:fresh --seed
php artisan optimize:clear
php artisan test
npm run build
```

## Email OTP (Reset Mot De Passe)

Configurer le SMTP dans .env (exemple Gmail SMTP):

- MAIL_MAILER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_ENCRYPTION=tls
- MAIL_USERNAME=...
- MAIL_PASSWORD=...
- MAIL_FROM_ADDRESS=...

## Export SQL

Export fourni:

- database/sql/emplois_db_full.sql

Import via phpMyAdmin > Import > choisir le fichier SQL.

## Structure Principale

- app/ (controllers, models, requests)
- resources/views/ (interfaces Blade)
- routes/ (web/auth)
- database/migrations et database/seeders
- public/ (assets publics)

## Livrables

Checklist academique dans LIVRABLES.md.
