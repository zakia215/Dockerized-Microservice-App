FROM php:8.0-apache

COPY . /var/www/html

# Update package repository and install necessary packages
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    mp3info

# Configure and install PostgreSQL and SOAP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo pdo_pgsql \
    && apt-get install -y libxml2-dev \
    && docker-php-ext-install soap

WORKDIR /var/www/html

COPY ./index.php .
COPY ./.htaccess .

RUN a2enmod rewrite

RUN service apache2 restart

EXPOSE 80