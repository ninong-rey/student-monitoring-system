FROM php:8.4-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libsqlite3-dev sqlite3 \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip pdo_sqlite \
    && a2enmod rewrite

# 2. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set working directory
WORKDIR /var/www/html

# 4. Copy files
COPY . .

# 5. Create .env file
RUN cp .env.example .env

# 6. Create all necessary directories
RUN mkdir -p /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/testing \
    /var/www/html/bootstrap/cache \
    /var/www/html/database

# 7. Create SQLite database
RUN touch /var/www/html/database/database.sqlite

# 8. Set permissions (owner: www-data for Apache)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/database

# 9. Install dependencies (as root, but we'll set ownership after)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 10. Run Laravel setup (as root, but directories already have correct permissions)
RUN php artisan key:generate --force \
    && php artisan config:cache \
    && php artisan route:cache

# 11. Configure Apache
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

EXPOSE 80

# Run migrations at container start
CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]