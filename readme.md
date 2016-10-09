# University of Mindanao QMO Web Application

## Requirements

- PHP 5.6+
- Composer

## Installation

- Clone the repo `git clone git@github.com:rosemalejohn/UM-QMO.git`
- Install dependencies `composer install`
- Install node modules `npm install`
- Run migrations `php artisan migrate`
- Seed the database `php artisan db:seed`

## Compiling

- `gulp watch` or `gulp watch --production` to minify assets

## Run the app

- Boot up the server `php artisan serve`