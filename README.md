# laravel-sandbox

An AI Automated Blog

## Install

-   copy .env.example to .env
-   composer install
-   ./vendor/bin/sail up -d
-   ./vendor/bin/sail artisan key:generate
-   ./vendor/bin/sail artisan migrate:fresh --seed
-   ./vendor/bin/sail artisan storage:link
-   npm install
-   npm run dev
