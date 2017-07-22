# Laravel Frontend Development Environment

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [laravel](http://laravel.com/)

## Installation

1. Clone [this repository](https://github.com/Alejandroem/garbo.git) to a location on your file system.
2. `cd` into the directoy, run `npm install`.
3. run `composer install`.
4. configure .env file with server settings.
    4.1 DB_HOST = "ip of the database server".
    4.2 DB_PORT = "port of the database server".
    4.3 DB_DATABASE = "database name".
    4.4 DB_USERNAME = "database user".
    4.5 DB_PASSWORD = "database password".
5. run `php artisan migrate install` to install migrations table.
6. run `php artisan migrate` to create the tables in the migrations files.