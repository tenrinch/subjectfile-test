# base image
FROM php:7.4-fpm

# get composer installer script
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install composer dependencies
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
    npm\
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


RUN docker-php-ext-enable opcache
RUN docker-php-ext-install calendar
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install json


#copy laravel ini
# COPY docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini

#set working directory
WORKDIR /var/www/html/subjectfile

# copy application file to the working directory
COPY . /var/www/html/subjectfile

# update and install composer
RUN composer update
RUN composer install --no-dev --no-interaction --prefer-dist

# # setup npm? is this step necessary
# RUN npm install -g npm@latest
# RUN npm install

# # include your other npm run scripts e.g npm rebuild node-sass

# # run your default build command here mine is npm run prod
# RUN npm run prod

# Change owner and permission of the working directory
RUN chown -R www-data:www-data .
RUN chmod -R 755 .
RUN chmod -R 777 public
RUN chmod -R 777 storage
RUN chmod -R 755 bootstrap/cache
RUN chown -R www-data.www-data bootstrap/cache
RUN chmod -R o+w storage

# start php-fpm
CMD ["php-fpm"]