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
];

