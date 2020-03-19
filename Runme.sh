#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [ "$role" = "app" ]; then

    exec php-fpm

elif [ "$role" = "queue" ]; then

    echo "Running the queue..."
    php /var/www/artisan queue:work --daemon


else
    echo "Please Send Valid Data\"$role\""
    exit 1
fi