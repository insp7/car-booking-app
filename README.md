# 🚗 Car Booking App

A Laravel-based web application for booking cars.

This guide explains how to **set up and run the project locally after
cloning the repository.**

# 🚀 First-Time Setup (Quick Version)

If you just cloned the repo, run:

``` bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
php artisan migrate
php artisan db:seed
php artisan serve
```

# 📦 Requirements

Make sure the following tools are installed:

-   PHP (8.x recommended)
-   Composer
-   Node.js
-   NPM
-   SQLite / MySQL / PostgreSQL

Check installations:

``` bash
php -v
composer -V
node -v
npm -v
```

# ⚙️ Project Setup in Detail

Follow these steps **in order**.

# 1. Clone the Repository

``` bash
git clone https://github.com/insp7/car-booking-app.git
cd car-booking-app
```

# 2. Install PHP Dependencies

Laravel backend dependencies are installed with Composer.

``` bash
composer install
```

# 3. Create the Environment File

Laravel requires an environment configuration file.

``` bash
cp .env.example .env
```

# 4. Generate Application Key

Laravel requires an application encryption key.

``` bash
php artisan key:generate
```

# 5. Configure the Database

Open `.env` and configure the database.

Example using **SQLite**:

    DB_CONNECTION=sqlite
    DB_DATABASE=database/database.sqlite

Create the SQLite database file:

``` bash
touch database/database.sqlite
```

# 6. Install Frontend Dependencies

Laravel uses **Vite** to compile frontend assets.

``` bash
npm install
```

# 7. Build Frontend Assets

Compile frontend assets required by Laravel.

``` bash
npm run build
```

This generates:

    public/build/
        manifest.json
        assets/

If you skip this step, you may see:

    Vite manifest not found at public/build/manifest.json

# 8. Run Database Migrations

Create the database tables.

``` bash
php artisan migrate
```

# 9. Seed the Database (Optional)

If the project contains seeders:

Run all seeders:

``` bash
php artisan db:seed
```

Run a specific seeder:

``` bash
php artisan db:seed --class=SeederName
```

Example:

``` bash
php artisan db:seed --class=UserSeeder
```

# 10. Reset Database and Seed (Optional)

To reset the database completely:

``` bash
php artisan migrate:fresh --seed
```

This will: - Drop all tables - Recreate them - Run seeders

# 11. Clear Laravel Cache (Recommended)

``` bash
php artisan optimize:clear
```

This clears cached: - configuration - routes - views - application cache

# 12. Run the Application

Start the Laravel development server:

``` bash
php artisan serve
```

The app will be available at:

    http://127.0.0.1:8000

# 13. Run Vite Dev Server (Optional for Development)

For live frontend updates:

``` bash
npm run dev
```

Run this **in a separate terminal** while Laravel is running.

# 🛠 Troubleshooting

## Vite Manifest Error

    Vite manifest not found at public/build/manifest.json

Fix:

``` bash
npm install
npm run build
```

## Database Errors

Make sure migrations have run:

``` bash
php artisan migrate
```

## Clear Laravel Cache

``` bash
php artisan optimize:clear
```

# 📄 License

MIT License
