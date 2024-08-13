## CURT Task Solution

A simplified inventory management system with roles (user/admin)

### Setup
- Clone the repository.
- `composer install`
- `npm install`
- `npm run build`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate --seed`

A default admin user will be created (username: admin, password: password).

Any new user is assigned the role "user".

This app is built with:
- Laravel
- TailwindCSS
- Vue.js
- Inertia.js
- DB: SQLite
