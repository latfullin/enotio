FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
        linux-headers \
        autoconf \
        build-base \
        curl 

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

# SET USER
ARG DOCKER_USER
ARG DOCKER_UID
ARG DOCKER_GROUP
ARG DOCKER_GID

# Create system user
RUN addgroup -g $DOCKER_GID $DOCKER_GROUP
RUN adduser -G www-data -u $DOCKER_UID -D -h /home/$DOCKER_USER $DOCKER_USER

# Set PHP user
RUN echo "user=$DOCKER_USER" >> $PHP_FPM_INI_CONF_DIR/www_custom.conf
RUN echo "group=$DOCKER_GROUP" >> $PHP_FPM_INI_CONF_DIR/www_custom.conf

# Clear
RUN docker-php-source delete \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

USER $DOCKER_USER:$DOCKER_GROUP

WORKDIR /var/www/html/public


CMD ["php-fpm"]

# Set crontab
COPY ./cron/crontab /etc/crontabs/cron
RUN /etc/crontabs/cron