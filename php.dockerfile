FROM php:7.4

RUN apt-get update && \
    apt-get install -y libzip-dev zip unzip git

RUN docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
