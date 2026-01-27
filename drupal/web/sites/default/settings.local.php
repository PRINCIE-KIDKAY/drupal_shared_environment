<?php

/**
 * @file
 * Local development override configuration file.
 *
 * This file is used for Docker/local development environments.
 * It overrides the SQLite configuration in settings.php with MySQL configuration.
 */

/**
 * Database configuration for Docker/MySQL.
 * 
 * This overrides the SQLite configuration in settings.php.
 * Reads configuration from environment variables set in .env file.
 */
$databases['default']['default'] = [
  'database' => getenv('DB_NAME') ?: 'drupal',
  'username' => getenv('DB_USER') ?: 'drupal',
  'password' => getenv('DB_PASSWORD') ?: 'drupal',
  'host' => getenv('DB_HOST') ?: 'db',
  'port' => getenv('DB_PORT') ?: '3306',
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
  // Performance optimizations for MySQL
  'init_commands' => [
    'isolation_level' => 'SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED',
  ],
  'pdo' => [
    \PDO::ATTR_EMULATE_PREPARES => FALSE,
    \PDO::ATTR_STRINGIFY_FETCHES => FALSE,
  ],
];

/**
 * Performance optimizations for Drupal.
 * 
 * NOTE: These settings are for production/optimized environments.
 * For development, you may want to disable caching by uncommenting
 * the cache backend settings below.
 */

// Enable page caching (recommended for production)
// Uncomment the following lines to DISABLE caching for development:
// $settings['cache']['bins']['render'] = 'cache.backend.null';
// $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
// $settings['cache']['bins']['page'] = 'cache.backend.null';

// Optimize class loader (use APCu if available)
if (extension_loaded('apcu')) {
  $settings['class_loader_auto_detect'] = TRUE;
}

// Performance: Skip file permissions check (faster on Docker)
$settings['skip_permissions_hardening'] = TRUE;

// Optimize file system operations
$settings['file_chmod_directory'] = 02775;
$settings['file_chmod_file'] = 0664;

