#!/bin/bash

# Don't exit on error immediately - we want to see what failed
set -e

echo "=== Docker Entrypoint Script Starting ==="

# Check if vendor directory exists, if not run composer install
if [ ! -f "/var/www/html/drupal/vendor/autoload.php" ]; then
    echo "Vendor directory not found. Running composer install..."
    echo "Current directory: $(pwd)"
    echo "Checking composer.json exists: $(test -f /var/www/html/drupal/composer.json && echo 'YES' || echo 'NO')"
    
    cd /var/www/html/drupal
    
    # Set composer memory limit and run install
    export COMPOSER_MEMORY_LIMIT=-1
    echo "Running composer install (this may take several minutes)..."
    
    if composer install --no-interaction --prefer-dist 2>&1; then
        echo "Composer install completed successfully."
    else
        COMPOSER_EXIT_CODE=$?
        echo "ERROR: Composer install failed with exit code: $COMPOSER_EXIT_CODE"
        echo "Please check the error messages above."
        exit $COMPOSER_EXIT_CODE
    fi
    
    # Verify autoload file exists
    if [ ! -f "/var/www/html/drupal/vendor/autoload.php" ]; then
        echo "ERROR: vendor/autoload.php was not created after composer install."
        echo "Listing vendor directory contents:"
        ls -la /var/www/html/drupal/vendor/ 2>&1 || echo "Vendor directory does not exist"
        exit 1
    fi
    echo "Verified: vendor/autoload.php exists"
else
    echo "Vendor directory found. Skipping composer install."
fi

# Fix permissions for specific directories that need write access
# Note: We don't chown the entire drupal directory as it's a volume mount
if [ -d "/var/www/html/drupal/web/sites/default/files" ]; then
    echo "Fixing permissions for sites/default/files..."
    chown -R www-data:www-data /var/www/html/drupal/web/sites/default/files 2>/dev/null || echo "Warning: Could not change ownership of files directory"
    chmod -R 755 /var/www/html/drupal/web/sites/default/files 2>/dev/null || echo "Warning: Could not change permissions of files directory"
fi

echo "Starting Apache..."
# Start Apache (this should not return)
exec apache2-foreground

