FROM php:8.1-apache

RUN apt-get update && apt-get install -y zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COPY . /var/www/html

WORKDIR /var/www/html

COPY ./yii2-app/apache-site.conf /etc/apache2/sites-available/000-default.conf

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
