## About Next-Basket

This application runs PHP-FPM, MYSQL, NGINX, phpMyAdmin and a seperate CRON job container. I have also added JIT compilation and OPCache to make the application faster in production.

## Language and Framework

This project is developed with the [Laravel 10.x](https://laravel.com) PHP framework.

## Setup Prerequisites

Clone the application on your local machine.

## Run the users service

- Change directory into the `users` directory and run `compose up --force-recreate --build -d` to run the users service app container

- You should then be able to access the `users` service via `http://127.0.0.1:1000`

## Run the notifications service

- Change directory into the `notifications` directory and run `compose up --force-recreate --build -d` to run the users service app container

- You should then be able to access the `users` service via `http://127.0.0.1:2000`

## API Documentation

The API has been documented using [swagger (OpenAPI) here](https://app.swaggerhub.com/apis-docs/JOBNEWTON3/petshop-api/1.0.0).

## Run the Tests

- To run the tests, simply run the `php artisan test` command.
- All Good!
