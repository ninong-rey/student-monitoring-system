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

# 4. Copy files and set initial permissions
COPY . .
RUN cp .env.example .env

# 5. Configure Apache (Consolidated and safer)
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# 6. Install Dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 7. Prepare Database & Fix Permissions
# We do this LAST so that files created by artisan are owned correctly
RUN mkdir -p /var/www/html/database storage bootstrap/cache && \
    touch /var/www/html/database/database.sqlite && \
    php artisan key:generate --force && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Note: We are NOT running migrations here. 
# It's better to run 'php artisan migrate' when the container starts.

EXPOSE 80

CMD ["apache2-foreground"]