FROM php:7.1.2-apache
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get install vim -y
RUN set -ex \
    && a2enmod include cgid \
    && sed -i 's/Options -Indexes/Options -Indexes +Includes/' /etc/apache2/conf-enabled/docker-php.conf
