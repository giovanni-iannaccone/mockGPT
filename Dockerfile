FROM php:8.1-apache

RUN apt-get update && apt-get install -y libcurl4-openssl-dev curl \
    && docker-php-ext-install curl

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
