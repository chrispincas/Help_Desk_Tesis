FROM php:7.4-apache
RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite && a2enmod headers
RUN docker-php-ext-install mysqli pdo pdo_mysql