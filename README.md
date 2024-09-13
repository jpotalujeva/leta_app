# Application
## Installation

```bash
git clone https://github.com/jpotalujeva/leta_app.git

cd ict/

touch .env
```

Inside .env file set database connection variables:

```php
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_local
DB_USERNAME=root
DB_PASSWORD=root
```
After that run

```bash
docker compose up --build
```
and wait for process to finish.
When containers are build run:

```php
docker exec -ti php sh
```
Inside container run:

```bash
composer install

php artisan migrate
php artisan db:seed
```
After these steps follow to http://localhost:8000/ 