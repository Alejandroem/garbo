# Laravel Frontend Development Environment

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [laravel](http://laravel.com/)
- [php>=5.6.4](http://php.net/)

## Installation

1. Clone [this repository](https://github.com/Alejandroem/garbo.git) to a location on your file system.
2. `cd` into the directoy, run `npm install`.
3. run `composer install`.
4. create a .env file at the root folther with the next settings:
    >APP_ENV=local
    >APP_DEBUG=true
    >APP_KEY=base64:hBfv9QqTJ8tpFU7MeBqUN28+SlVJ64aVZH3q6x5joiA=
    >APP_URL=http://localhost

    >DB_CONNECTION=sqlsrv
    >DB_HOST=ip of the database server
    >DB_PORT=port of the database server
    >DB_DATABASE=database name
    >DB_USERNAME=database user
    >DB_PASSWORD=database password

    >CACHE_DRIVER=file
    >SESSION_DRIVER=file
    >QUEUE_DRIVER=sync

5. run `php artisan migrate install` to install migrations table.
6. run `php artisan migrate` to create the tables in the migrations files.