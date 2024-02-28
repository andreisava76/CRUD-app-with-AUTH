## Installation
First clone this repository, install the dependencies, and setup your .env file.
- git clone https://github.com/andreisava76/simple-crud-with-auth simple-crud-with-auth
- composer update
- composer install
- cp .env.example .env

Generate your application encryption key using `php artisan key:generate`.

Then create the necessary database and run the initial migrations and seeders.

- php artisan migrate --seed
