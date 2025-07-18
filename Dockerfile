# Use official PHP Apache image
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable mod_rewrite for clean URLs
RUN a2enmod rewrite

# Copy all files from "public" to Apache root directory
COPY public/ /var/www/html/

# Allow .htaccess overrides
RUN printf "<Directory /var/www/html/>\n\
    AllowOverride All\n\
</Directory>\n" > /etc/apache2/conf-available/override.conf && \
    a2enconf override

# Expose port 80 (default)
EXPOSE 80
