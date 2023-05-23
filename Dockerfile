FROM php:7.4-apache

# 777 COPY ./ /var/www/html/
#COPY .env-example .env

COPY _archivos_apoyo/000-default.conf /etc/apache2/sites-available/
WORKDIR /var/www/html/

RUN apt-get update && \
    apt-get install -y libfreetype6-dev 
RUN apt-get install -y libjpeg62-turbo-dev 
RUN apt-get install -y libpng-dev 
RUN apt-get install -y mc 
RUN apt-get install -y nmap zip

#RUN apt-get install -y git-all
RUN apt-get install \
      libzip-dev \
      zip \
    && docker-php-ext-install zip

RUN apt-get install -y libxml2-dev \
    && docker-php-ext-install soap \
    && docker-php-ext-enable soap

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

RUN docker-php-ext-install bcmath

RUN apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Dockerfile for Imagick (PHP7.X)
#RUN apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/* \
#    && printf "\n" | pecl install imagick \
#    && docker-php-ext-enable imagick

RUN a2enmod rewrite
RUN chmod 777 ./ -R && service apache2 restart

#RUN php composer.phar install


