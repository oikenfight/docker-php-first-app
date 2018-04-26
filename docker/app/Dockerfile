FROM php:7.2-fpm-alpine3.7

ARG COMPOSER_VERSION=1.6.3

#
# php7, mysql, nodejs
#
RUN apk --no-cache update \
  && apk --no-cache upgrade \
  && apk --no-cache add \
    curl-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    zlib-dev \
    pcre-dev \
    g++ \
    make \
    autoconf \
    openssl \
    nodejs-npm \
    bash \
  && docker-php-ext-install \
    curl \
    dom \
    mbstring \
    pdo \
    pdo_mysql \
    simplexml \
    zip \
    opcache

#
# composer
#
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} \
  && chmod +x /usr/local/bin/composer \
  && rm -rf /var/cache/apk/*

#
# php.ini
#
COPY docker/app/usr/local/etc/php/conf.d/php.ini /usr/local/etc/php/php.ini

#
# log
#
COPY docker/app/usr/local/etc/php-fpm.d/ /usr/local/etc/php-fpm.d/
RUN touch /var/log/fpm-php.www.log && chmod 777 /var/log/fpm-php.www.log
