<h1>Coding Challenge 2 - Announcement App</h1>
<ul>
    <li>This app is using Laravel Passport</li>
</ul>

<h3>Setup</h3>
<ul>
    <li><i>composer install</i></li>
    <li><i>php artisan migrate --seed</i> <br/>
        <small><i>This populates users, roles and announcements</i></small>
    </li>
    <li><i>php artisan passport:install</i> <br/>
        <small><i>get CLIENT ID and CLIENT SECRET and update .env file. See .env.example.</i></small>
    </li>   
    <li>Create two databases one for the app and one for the unit test and update .env file.</li>
</ul>

<h3>Others</h3>
<ul>
    <li>Run <i>php artisan test</i> for unit test</li>
</ul>
