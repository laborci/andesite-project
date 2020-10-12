#!/bin/bash

cp ./app/public/~maintenance/index.php ./app/public/index.php
git fetch
git pull
composer install
npm install
npm run build
andesite mig:go
andesite env
andesite vhost
service apache2 reload
cp ./dev/assets/index.php ./app/public/index.php
