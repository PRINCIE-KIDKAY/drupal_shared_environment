#!/bin/bash
set -e

# Check if vendor directory exists, if not run composer install
if [ ! -f "/var/www/html/drupal/vendor/autoload.php" ]; then
    echo "Vendor directory not found. Running composer install..."
    composer install --working-dir=/var/www/html/drupal --no-interaction --prefer-dist
    echo "Composer install completed."
else
    echo "Vendor directory found. Skipping composer install."
fi

# Fix permissions
chown -R www-data:www-data /var/www/html/drupal

# Start Apache
exec apache2-foreground

