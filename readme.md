## Web Practical Exam

Basic User Management System using laravel & vuejs.


Installing Dependencies

- composer install
- npm install


Migrations and Seeder(Default users)
- php artisan migrate --seed


Generate client credentials for tokens:

- php artisan passport:install
- php artisan passport:client --client


Additional in .env file

- MIX_CLIENT_ID=(generated client id from passport:client command)
- MIX_CLIENT_SECRET=(generated client secret from passport:client command)


Routes URL used with Verb using laravel passport:

- GET ACCESS TOKEN: Verb:GET, URL:http://localhost:8000/oauth/token
- Create: Verb:POST, URL:http://localhost:8000/api/users
- Update: Verb:PUT, URL:http://localhost:8000/api/users/{id}
- Delete: Verb:DELETE, URL:http://localhost:8000/api/users/{id}


Run Locally:

- composer dumpautoload;php artisan config:clear;php artisan cache:clear; (preventing some issues)
- php artisan serve
- npm run dev


Default Admin Creds:
- Username: admin@admin.com
- Password: Password!123









