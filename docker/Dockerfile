FROM php:7.3-apache

WORKDIR /var/www

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# RUN pecl install -o -f xdebug-3.1.3 \
#     && rm -rf /tmp/pear

# Copy composer installable
COPY ./install-composer.sh ./

# Copy php.ini
COPY ./php.ini /usr/local/etc/php/

# Cleanup packages and install composer
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

# Change the current working directory
WORKDIR /var/www

# Change the owner of the container document root
RUN chown -R www-data:www-data /var/www

# Start Apache in foreground
CMD ["apache2-foreground"]