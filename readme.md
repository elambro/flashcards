# Flashcards
A small app for practicing vocabulary and grammar in new languages built on Laravel 6.0, Nova, and Vue.js

## Installation
- Clone the repository
- Save a Google Cloud key file for access to translations and text to speech
- `cp .env.example .env`
- Complete the .env file
- `composer install`
- `php artisan migrate`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan storage:link`
- `npm install`

## Nova
I used Nova for the admin dashboard. Either add Nova to the project (if you have access to it) or remove it from the composer.json requirements.
