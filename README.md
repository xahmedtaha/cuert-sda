## CURT Task Solution

A simplified inventory management system with roles (user/admin)

DEMO: [http://curt-sda.free.nf/]

### Setup
- Install PHP 8.3
- Clone the repository.
- `composer install`
- `npm install`
- `npm run build`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate --seed`
- php artisan serve
- Access the app at localhost:8000

A default admin user will be created (username: admin, password: password).

Any new user is assigned the role "user".

This app is built with:
- Laravel
- TailwindCSS
- Vue.js
- Inertia.js
- DB: SQLite
