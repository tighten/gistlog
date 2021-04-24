#!/bin/bash

cp .env.example .env
composer install
php artisan key:generate
npm install
npm run dev

echo "Remember to customize .env.example, and create a new GitHub app and token (see readme)"
