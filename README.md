<p align="center"><a href="#" target="_blank"><img src="https://i.postimg.cc/VLdr3kDN/logo.png" width="200"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

----------

# Getting started

## Installation

Clone the repository

    git clone git@github.com:ahnayem/phone-book.git

Switch to the repo folder

    cd phone-book

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Link storage to the public folder

    php artisan storage:link

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate


Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:ahnayem/phone-book.git
    cd phone-book
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data to store admin info, application primary setup info, role, permission etc**


Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command. If the database already clean then ignore this step.

    php artisan migrate:refresh

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Http/Middleware` - Contains the middleware
- `config` - Contains all the application configuration files
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the web routes defined in web.php file
- `resources` - Contains all the view blade file
- `public` - Contains all the assets file, storage link folder
- `tests` - Contains all the application tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

 
# Authentication
 
Initial Admin Pannel credentials.
 
    admin@gmail.com
    abcd1234
    
    
To Create User follow this link.
 
    http://localhost:8000/register
    
    
To Login follow to this link.
 
    http://localhost:8000/login

----------

## Contributing

Feel free to contribute this repo.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to me via [nayem.csevu@gmail.com](mailto:nayem.csevu@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
