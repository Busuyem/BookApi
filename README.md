Backend API Development With Laravel

To set the app follow these:

1) clone the repo
2) run composer install/update
3) create a database and give it your desired name
4) run "cp .env.example .env" in the project directory
5) update the .env file with the details of your created database
6) run "php artisan key:gen"
7) run "php artisan migrate"
8) run "php artisan serve"

 API endpoint for task 1

 Get external api
127.0.0.1:8000/api/external-books

API endpoints for Task 2
Post endpoint
127.0.0.1:8000/api/v1/books

Get enpoint for READ
127.0.0.1:8000/api/v1/books

Patch endpoint for UPDATE
127.0.0.1:8000/api/v1/books/:id

Delete endpoint
127.0.0.1:8000/api/v1/books/:id

Get endoint for SHOW
127.0.0.1:8000/api/v1/books/:id




