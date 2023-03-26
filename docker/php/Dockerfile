FROM php:8.2-fpm-alpine

ARG APCU_VERSION=5.1.22

RUN apk add --update --no-cache \
    bash \
    linux-headers \
    ca-certificates \
    git \
    oniguruma-dev \
    libxml2-dev \
    unzip \
    libzip-dev zlib-dev \
    su-exec \
    icu-dev \
    vim && \
    apk add --update --no-cache --virtual .build-deps \
        $PHPIZE_DEPS && \
    pecl install apcu-${APCU_VERSION} && \
    pecl install xdebug && \
    docker-php-ext-install intl zip mysqli pdo_mysql mbstring && \
    docker-php-ext-enable  xdebug && \
    docker-php-ext-enable opcache apcu && \
    apk del .build-deps && \
    addgroup bar && \
    adduser -D -h /home -s /bin/bash -G bar foo

ARG COMPOSER_VERSION=2.5.1
RUN curl -sS https://getcomposer.org/installer \
        | php -- --filename=composer --install-dir=/usr/local/bin --version=${COMPOSER_VERSION}

COPY config/php.ini ${PHP_INI_DIR}/php.ini
COPY config/xdebug.ini ${PHP_INI_DIR}/conf.d/xdebug.ini

ADD entrypoint.sh /entrypoint

WORKDIR /srv

ENTRYPOINT ["/entrypoint"]
