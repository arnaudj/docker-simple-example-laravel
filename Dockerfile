FROM php:7.4-apache-buster
LABEL maintainer="Arnaud J"

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  zlib1g-dev \
  libxml2-dev \
  libzip-dev \
  libonig-dev \
  unzip \ 
  zip \ 
  git

RUN docker-php-ext-install \
  mbstring \
  pdo \
  pdo_mysql \ 
  opcache \
  && a2enmod rewrite negotiation \
  && service apache2 restart

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
# COPY docker/php/ /etc/php/7.4/fpm # Enable to deploy a custom php.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.9.2

COPY --chown=www-data:www-data project/ /var/www/html/
RUN mkdir -p /project/bootstrap/cache \
  mkdir -p /project/storage/framework/sessions \
  mkdir -p /project/storage/framework/views \
  mkdir -p /project/storage/framework/cache

WORKDIR /var/www/html/

RUN composer install --prefer-dist --optimize-autoloader --classmap-authoritative --no-dev --quiet
RUN php artisan key:generate
RUN php artisan migrate --force
RUN chown -R www-data:www-data /var/www/html/
EXPOSE 80