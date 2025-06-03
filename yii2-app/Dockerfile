FROM php:8.2-apache

RUN apt-get update && apt-get install -y zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./yii2-app /var/www/html/yii2-app

WORKDIR /var/www/html/yii2-app

RUN composer install --no-dev --optimize-autoloader

COPY ./yii2-app/apache-site.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/yii2-app

EXPOSE 80
