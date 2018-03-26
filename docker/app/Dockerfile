FROM php:7.2-fpm-alpine

ARG COMPOSER_VERSION=1.5.2

#
# php7, mysql   　　  　　　
#
RUN apk --no-cache update \
  && apk --no-cache upgrade \
  && apk --no-cache add \
    g++ \
    make \
  && docker-php-ext-install \
    mbstring \
    mysqli \
    pdo \
    pdo_mysql

#
# composer
#
RUN apk --no-cache add \
    curl \
  && curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    --version=${COMPOSER_VERSION} \
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
