## Installation
First clone this repository, install the dependencies, and setup your .env file.
- git clone https://github.com/andreisava76/simple-crud-with-auth simple-crud-with-auth
- composer install
- cp .env.example .env

Then create the necessary database and run the initial migrations and seeders.

- php artisan migrate --seed

You can edit, delete or add new users only as admin. Login with the email adress 'admin@test.com' and password 'password' and you are good to go.
