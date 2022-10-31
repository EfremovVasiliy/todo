FROM php:8.1-fpm
MAINTAINER Vasiliy

RUN apt-get update && \
    apt-get install -y libzip-dev && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql mysqli pdo_mysql zip
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/todo

CMD ["php-fpm"]
CMD composer install
CMD bin/doctrine orm:schema-tool:create
CMD ["php-fpm"]
