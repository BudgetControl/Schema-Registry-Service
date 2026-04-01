FROM php:8.2-cli

# Install system dependencies and the PostgreSQL PDO extension
RUN apt-get update && apt-get install -y \
        libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist

# Copy the rest of the source
COPY . .

CMD ["vendor/bin/phinx", "migrate", "-c", "phinx.php"]
