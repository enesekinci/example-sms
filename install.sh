#!/bin/bash

cp .env.example .env

source .env

docker-compose down

docker-compose up -d

docker-compose exec app php artisan key:generate
docker-compose exec app php artisan jwt:secret

docker-compose exec app composer install

docker-compose exec app php artisan storage:link

docker-compose exec app php artisan migrate

docker-compose exec app php artisan migrate --database=testing

docker-compose exec app php artisan test

