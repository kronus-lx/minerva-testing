FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mysqli

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Enable Apache modules
RUN a2enmod rewrite

# Set ServerName to suppress warning
RUN echo "ServerName minerva-test.local" >> /etc/apache2/apache2.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Copy application files
COPY . /var/www/html

# Set working directory for Composer
WORKDIR /var/www/html/server

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-interaction --no-dev

# Expose port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
