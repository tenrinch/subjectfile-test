FROM php:7.4-fpm
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    libz-dev \
    mariadb-client-10.5 \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libssl-dev \
    libzip-dev \
    unzip \
    zip \
    nodejs \
    && apt-get clean \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
    gd \
    exif \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    pcntl \
    zip \
    && rm -rf /var/lib/apt/lists/*;
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
COPY docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini
COPY . /usr/src/app
WORKDIR /usr/src/app
RUN composer update
RUN composer install
# RUN chmod -R 755 ./
# RUN chown -R www-data:www-data .
# test this permission 
RUN chown -R www-data:www-data ./public
RUN chown -R www-data:www-data ./storage
RUN chown -R $USER:www-data .
RUN find . -type f -exec chmod 664 {} \;   
RUN find . -type d -exec chmod 775 {} \;
RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache
CMD [ "php-fpm" ]