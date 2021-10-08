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
COPY docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini
WORKDIR /usr/src/app
COPY . /usr/src/app
RUN composer update
RUN composer install
RUN chown -R www-data:www-data .
RUN chmod -R 755 ./