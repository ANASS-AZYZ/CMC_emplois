# CMC_emplois

Application de gestion des emplois du temps (Admin / Formateur / Consultation).

## 1) Prerequis

- PHP 8.2+
- Composer
- Node.js 18+ et npm
- MySQL / MariaDB
- Serveur local (XAMPP, WAMP, Laragon, etc.)

## 2) Etapes d'installation

1. Cloner le projet :

```bash
git clone https://github.com/ANASS-AZYZ/CMC_emplois.git
cd CMC_emplois
```

2. Installer les dependances backend/frontend :

```bash
composer install
npm install
```

3. Configurer l'environnement :

```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de donnees dans `.env` (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5. Initialiser la base :

```bash
php artisan migrate --seed
```

6. Lancer l'application :

```bash
php artisan serve
npm run dev
```

Application disponible sur `http://127.0.0.1:8000`.

## 3) Commandes utiles

- Migration + seed : `php artisan migrate --seed`
- Reset complet DB : `php artisan migrate:fresh --seed`
- Build production assets : `npm run build`
- Lancer les tests : `php artisan test`

## 4) Acces aux comptes de test

Les comptes suivants sont garantis par le seeding :

- Admin
	- Email: `admin@cmc.ma`
	- Mot de passe: `password123`
- Formateur
	- Email: `formateur@cmc.ma`
	- Mot de passe: `password123`

## 5) Base de donnees exportee (.sql)

Un export complet prêt pour phpMyAdmin est fourni ici :

- `database/sql/emplois_db_full.sql`

Import rapide dans phpMyAdmin:

1. Ouvrir phpMyAdmin
2. Aller dans `Import`
3. Choisir `database/sql/emplois_db_full.sql`
4. Executer

## 6) Contenu du depot

Le depot inclut :

- Migrations (`database/migrations`)
- Seeders (`database/seeders`)
- Configuration Laravel (`config`, `.env.example`, etc.)
- Code source complet (controllers, models, views, routes)

## 7) Livrables académiques

Voir `LIVRABLES.md` pour la checklist complete du depot + support physique (CD), noms de fichiers attendus et structure du rapport.
