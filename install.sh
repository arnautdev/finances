#!/bin/bash

# first step run composer installer
if [ ! -d 'vendor' ]; then

    echo "Runing composer.install";
    composer install
    echo "End COMPSER.INSTALL";
    echo "\n";
fi


# second step run npm install
if [ ! -d 'node_modules' ]; then

    echo "Runing npm.install";
    npm install
    echo "End NPM.INSTALL";
    echo "\n";
fi

# THird step create .env file
if [ ! -f '.env' ]; then
    echo "Create (.env) file";
    cp .env.example .env
    echo "(.env) file was created ";
    echo "\n";
fi

php artisan key:generate

