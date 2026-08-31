# syntax=docker/dockerfile:1.7

ARG PHP_VERSION=8.3
ARG NODE_VERSION=22

FROM node:${NODE_VERSION}-bookworm-slim AS assets

WORKDIR /app

COPY package*.json ./
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

FROM php:${PHP_VERSION}-apache-bookworm AS app

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        unzip \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp; \
    docker-php-ext-install -j"$(nproc)" \
        bcmath \
        curl \
        gd \
        intl \
        mbstring \
        opcache \
        pcntl \
        pdo_mysql \
        zip; \
    pecl install redis; \
    docker-php-ext-enable redis; \
    rm -f /etc/apache2/mods-enabled/mpm_event.conf \
      /etc/apache2/mods-enabled/mpm_event.load \
      /etc/apache2/mods-enabled/mpm_worker.conf \
      /etc/apache2/mods-enabled/mpm_worker.load; \
    a2enmod mpm_prefork; \
    a2enmod headers remoteip rewrite; \
    rm -rf /var/lib/apt/lists/* /tmp/pear ~/.pearrc

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/apache/ports.conf /etc/apache2/ports.conf
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/zz-opcache.ini

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

COPY . .
COPY --from=assets /app/public/build ./public/build

RUN set -eux; \
    composer dump-autoload --no-dev --no-interaction --optimize; \
    mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/testing \
        storage/framework/views \
        storage/logs \
        bootstrap/cache; \
    chown -R www-data:www-data storage bootstrap/cache public/build; \
    chmod -R ug+rwX storage bootstrap/cache public/build; \
    chmod +x docker/start.sh

EXPOSE 10000

CMD ["docker/start.sh"]
