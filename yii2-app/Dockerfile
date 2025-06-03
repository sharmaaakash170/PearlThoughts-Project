FROM php:8.3-apache

RUN apt-get update && apt-get install -y zip unzip git \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./yii2-app /var/www/html/yii2-app

WORKDIR /var/www/html/yii2-app

RUN composer install --optimize-autoloader

COPY ./yii2-app/apache-site.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html/yii2-app

ENV YII_ENV=prod 

ENV YII_ENV_DEV=0

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD curl -f http://localhost/index.php || exit 1
