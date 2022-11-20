### Instructions for Running the App

#### Initial Setup
After cloning the repository, install composer and npm packages:

    composer install
    npm install

Create the `.env` file by copying `.env.example` file. Modify as needed.

It is recommended to run the app using `sail`. Start sail by running:

    ./vendor/bin/sail up

While that is completing, you can build the client-side:

    npm run build

After `sail` is up and running, log into the docker container using:

    docker exec -it jetstream-inertia-test-laravel.test-1 /bin/bash

Once logged in to the container, we have to run a collection of self-explanatory commands:

    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan storage:link

#### Email Functionality

For email functionality, please configure a mail provider.

#### Finishing up

Register a new using the Register page.

Now you can use the app and purchase products by adding to shopping cart.

#### Admin Access

Right now, admin is a pre-seeded and hardcoded user with the following `username:passord` combination:
    
    admin@admin.com:fijas123
    
