FROM php:8.3-cli-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    git \
    unzip \
    zip \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo_mysql intl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs || true \
    && php artisan key:generate || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
