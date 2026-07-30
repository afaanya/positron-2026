# Positron 2026 — production image for Render (Laravel 11 / PHP 8.2 + Supabase Postgres)
# syntax=docker/dockerfile:1

# ---- Stage 1: compile front-end assets with Vite ----
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# ---- Stage 2: PHP runtime ----
FROM php:8.2-cli-bookworm AS app

# System libs for the PHP extensions Laravel + Supabase (pgsql) + Firebase need
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libpq-dev libonig-dev libzip-dev libicu-dev \
        libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql pgsql mbstring bcmath zip intl gd exif pcntl \
    && rm -rf /var/lib/apt/lists/*

# Composer (copied from the official image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# App source, then overlay the built Vite assets from stage 1
COPY . .
COPY --from=assets /app/public/build ./public/build

# PHP dependencies (production) + optimized autoloader
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Boot script (cache config, migrate, serve on Render's $PORT)
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080
CMD ["start.sh"]
