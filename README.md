## Install Chat App Built using Laravel 11, Breeze, Reverb, Tailwind CSS
Laravel chat application

## #Steps to Build the Chat Application
Install Laravel 11
Set Up Authentication
Install Laravel Echo & Reverb
Create Models, Migrations & Controllers
Broadcast Messages with Laravel Echo
Create Chat UI with Bootstrap
Listen for Messages in Real-Time
<pre>
composer create-project laravel/laravel chat-app
cd chat-app
cp .env.example .env
</pre>

<pre>
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
</pre>

<pre>
php artisan install:broadcasting
</pre>

Full blog is available at [programmingmindset.com](https://programmingmindset.com/post/laravel-11-chat-app-using-reverb-broadcasting-event)
