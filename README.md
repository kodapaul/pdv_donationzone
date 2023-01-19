## About The Project

I want to create a simple donation website where you can utilize payment transaction from paypal. I used the following stacks to create this project

-   Laravel 9
-   Tailwind V3
-   Flowbite
-   Srmklive Paypal

## Step-by-step guide to run the project

-   Clone git repository.
-   after cloning run from your terminal "composer install"
-   create a database to your local mysql 3306. Database name: pdv_technical
-   Create a new .env file on your laravel folder and copy the content from env.example
-   run "php artisan migrate:fresh" on your terminal to create database tables
-   run "php artisandb:seed" on your terminal to create sample datas
-   run "npm install" on your laravel folder to install node dependencies
-   run "npm run dev" or "npm run watch" on your laravel folder to initiate js templates
-   finally run "php artisan serve" to test project

## Sample Credentials for customer to use paypal

-   Email: sample-bueyer-pdv@personal.example.com
-   Password: bFQw2Q-=
