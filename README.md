# steps
- clone project
- then run:
``
composer install
``
- run laravel sail to build project
``
./vendor/bin/sail up
``
- to run project run 
`` 
./vendor/bin/sail up -d
``
- to stop the project
`` 
./vendor/bin/sail down
``
- in .env file change APP_PORT to any port you need or copy .env.example to .env

- make sure to send x-api-key in request header with token
