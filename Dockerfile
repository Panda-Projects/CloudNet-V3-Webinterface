FROM php:8.1-apache

WORKDIR /var/www/html/

RUN apt-get update && apt-get install -y git curl
RUN git clone https://github.com/Panda-Projects/CloudNet-V3-Webinterface.git /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install --no-dev -o

# Enabling ae2 rewrites
RUN a2enmod rewrite

# Change document root
RUN sed -ri -e 's!/var/www/html/public' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80