# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install MySQL extension for PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy all project files into Apache web directory
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80 to the web
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
