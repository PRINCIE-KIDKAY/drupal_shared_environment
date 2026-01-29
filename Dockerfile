FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions required by Drupal
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsqlite3-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql pdo \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-install gd \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install xml \
    && docker-php-ext-install zip \
    && docker-php-ext-install opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files (vendor is excluded via .dockerignore)
# This ensures files are available in production without volume mounts
COPY . /var/www/html

# Enable Apache mod_rewrite and other performance modules
RUN a2enmod rewrite headers expires deflate mpm_prefork

# Configure Apache MPM prefork for optimal performance with 4 CPU cores
# This allows Apache to handle more concurrent requests
RUN { \
    echo '<IfModule mpm_prefork_module>'; \
    echo '    StartServers            8'; \
    echo '    MinSpareServers         5'; \
    echo '    MaxSpareServers         20'; \
    echo '    ServerLimit             256'; \
    echo '    MaxRequestWorkers       256'; \
    echo '    MaxConnectionsPerChild  10000'; \
    echo '</IfModule>'; \
} > /etc/apache2/conf-available/mpm-prefork.conf && \
    a2enconf mpm-prefork

# Set optimized PHP.ini settings for Drupal performance
# Optimized for 4 CPU cores and 6GB+ available RAM
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=512M'; \
    echo 'opcache.interned_strings_buffer=32'; \
    echo 'opcache.max_accelerated_files=20000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.validate_timestamps=1'; \
    echo 'opcache.save_comments=1'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=0'; \
    echo 'opcache.max_wasted_percentage=10'; \
    echo ''; \
    echo 'upload_max_filesize=64M'; \
    echo 'post_max_size=64M'; \
    echo ''; \
    echo 'memory_limit=512M'; \
    echo 'max_execution_time=300'; \
    echo 'max_input_time=300'; \
    echo 'max_input_vars=5000'; \
    echo ''; \
    echo 'realpath_cache_size=8192K'; \
    echo 'realpath_cache_ttl=3600'; \
    echo ''; \
    echo 'max_children=50'; \
    echo 'process_idle_timeout=10s'; \
} > /usr/local/etc/php/conf.d/drupal.ini



# Configure Apache for Drupal with performance optimizations
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf \
    && echo '    ServerAdmin webmaster@localhost' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot /var/www/html/web' >> /etc/apache2/sites-available/000-default.conf \
    && echo '' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    # Performance optimizations' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    EnableSendfile Off' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    FileETag None' >> /etc/apache2/sites-available/000-default.conf \
    && echo '' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory /var/www/html/web>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Options -Indexes +FollowSymLinks' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    # Enable compression' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Location />' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        SetOutputFilter DEFLATE' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png|zip|gz|bz2|pdf)$ no-gzip dont-vary' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Location>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Copy entrypoint script and fix line endings (Windows CRLF to Unix LF)
COPY docker-entrypoint.sh /usr/local/bin/
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint.sh && \
    chmod +x /usr/local/bin/docker-entrypoint.sh

# Set proper permissions for copied files
# Note: This sets ownership, but write permissions for sites/default/files
# will be handled by the entrypoint script at runtime
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Use entrypoint script
ENTRYPOINT ["docker-entrypoint.sh"]
