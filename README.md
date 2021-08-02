<h1>Setup</h1>
- composer install
- php artisan migrate --seed
- php artisan passport:install
  get CLIENT ID and CLIENT SECRET and update .env file. See .env.example.
- Create two databases one for the app and one for the unit test and updat e.env file.