#**Cited**

Copy .env.example to .env

Setup database in .env and create db

`DB_DATABASE=cited`
`DB_USERNAME=root`
`DB_PASSWORD=root`

#####_Commands to run:_

`composer install`

`npm install`

`php artisan migrate:refresh --seed`

`php artisan key:generate`

`npm run dev`

`php artisan queue:work --queue=default,emails`

