# syntax=docker/dockerfile:1.7

ARG PHP_VERSION=8.4

FROM php:${PHP_VERSION}-fpm-alpine AS base

RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    linux-headers \
    $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" bcmath exif gd intl opcache pcntl pdo_mysql zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del linux-headers $PHPIZE_DEPS

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-salomao.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/zz-salomao.conf
COPY docker/entrypoint/app.sh /usr/local/bin/app-entrypoint

RUN chmod +x /usr/local/bin/app-entrypoint

FROM base AS dev
ENV APP_ENV=local
ENV COMPOSER_ALLOW_SUPERUSER=1

ENTRYPOINT ["app-entrypoint"]
CMD ["php-fpm", "-F"]

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

FROM base AS prod
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /var/www
COPY --from=vendor /app/vendor /var/www/vendor
COPY --from=assets /app/public/build /var/www/public/build

RUN rm -rf node_modules tests docker \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && composer dump-autoload --no-dev --classmap-authoritative

ENTRYPOINT ["app-entrypoint"]
USER www-data
CMD ["php-fpm", "-F"]
