
## If you want to run this project please follow the instruction

After clene this project 
- run `composer update`
- run `npm install && npm run dev`
- run `copy .env.example .env`
- run `php artisan key:generate`

then go to MySql and create a database name `bro_tech_task`

run `php artisan migrate:refresh --seed`
then run `php artisan serve`

