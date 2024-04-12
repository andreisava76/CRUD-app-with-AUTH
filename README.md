

This is a Laravel project with verifying your registered romanian phone number via SMS, after the registration. Once registered, you can view a list of users. You can login as admin with email: 'admin@test.com' and password 'password' to edit, delete or add new users.

## Installation

First clone this repository, install the dependencies, and setup your .env file.

- git clone https://github.com/andreisava76/simple-crud-with-auth simple-crud-with-auth
- composer update
- composer install
- cp .env.example .env and enter your smso api key there
Generate your application encryption key using `php artisan key:generate`.

Create the necessary database and run the initial migrations and seeders using `php artisan migrate --seed`.
