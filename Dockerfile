# Use the official PHP 8.2 image with Apache preinstalled
FROM php:8.2-apache

# Copy all project files to Apache's web root directory
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Ensure index.php is the default entry point
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Expose port 80 to the web
EXPOSE 80

# Start Apache in the foreground (so Render keeps it running)
CMD ["apache2-foreground"]
