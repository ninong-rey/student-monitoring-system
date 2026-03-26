FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libsqlite3-dev sqlite3

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Create .env file from .env.example
RUN cp .env.example .env

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/database

# Create SQLite database file
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chmod 777 /var/www/html/database/database.sqlite

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Run Laravel setup
RUN php artisan key:generate --force
RUN php artisan config:cache
RUN php artisan route:cache
# RUN php artisan view:cache  (REMOVED - causes error)
RUN php artisan migrate --force
RUN php artisan db:seed --force

# Configure Apache to use public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]