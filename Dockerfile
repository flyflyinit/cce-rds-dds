FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini-development
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini-production
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer self-update
COPY composer.json  /var/www/html/composer.json
RUN apt-get update && apt-get upgrade -y
RUN apt-get install unzip zip
RUN composer install
COPY src/ /var/www/html/