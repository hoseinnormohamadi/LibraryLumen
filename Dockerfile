FROM php:7.4-fpm

COPY composer.lock composer.json /var/www/
WORKDIR /var/www

RUN apt-get update --fix-missing && apt-get install -y  \
    build-essential \
    libssl-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlibc \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    zip
RUN set -eux; apt-get update; apt-get install -y libzip-dev zlib1g-dev; docker-php-ext-install zip
RUN docker-php-ext-install opcache  && docker-php-ext-enable opcache

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql exif pcntl
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer




COPY Runme.sh /usr/local/bin/start

RUN chown -R www-data:www-data /var/www \
    && chmod u+x /usr/local/bin/start

EXPOSE 9000
CMD ["/usr/local/bin/start"]
