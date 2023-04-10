FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
        linux-headers \
        autoconf \
        build-base \
        curl \
        supervisor 

# Install ext
RUN docker-php-ext-install \
        pdo \
        pdo_mysql 

# Install Pecl extension
RUN pecl install xdebug-3.2.1 && \
  docker-php-ext-enable xdebug 

# PHP - config folder
ARG PHP_INI_CONF_DIR="$PHP_INI_DIR/conf.d"
ARG PHP_FPM_INI_CONF_DIR="$PHP_INI_DIR/../php-fpm.d"

# PHP FPM - config
COPY ./config/www.conf $PHP_FPM_INI_CONF_DIR/www_custom.conf

# Config Xdebug extension
COPY ./config/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install nodejs
RUN apk add --no-cache \
    nodejs \
    npm

# Clear
RUN docker-php-source delete \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

# Config Supervisor
COPY ./supervisor /etc/supervisor
RUN mkdir -p /var/log/supervisor

WORKDIR /var/www/html/public

# Set crontab
COPY ./cron/crontab /etc/crontabs/cron

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]