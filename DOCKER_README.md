# Docker Setup for Drupal

This guide will help you run your Drupal application using Docker and Docker Compose.

## Prerequisites

- Docker Desktop (or Docker Engine + Docker Compose)
- Git (optional, for cloning)

## Quick Start

1. **Create your `.env` file:**
   ```bash
   cp .env.example .env
   ```
   Then edit `.env` with your database credentials.

2. **Build and start the containers:**
   ```bash
   # For local development with Docker MySQL
   docker-compose -f docker-compose.prod.yml up -d
   
   # OR for external database
   docker-compose -f docker-compose.local.yml up -d
   ```
   
   **Note:** On first run, the container will automatically run `composer install` to install PHP dependencies. This may take a few minutes.

3. **Access your Drupal site:**
   - Drupal: http://localhost:8080 (prod) or http://localhost:20100 (local)
   - phpMyAdmin: http://localhost:8081 (prod) or http://localhost:20101 (local)

4. **Database Configuration:**
   All database settings are read from the `.env` file. The `settings.local.php` file automatically uses these environment variables.

## First Time Setup

### Option 1: Fresh Installation

1. Navigate to http://localhost:8080
2. Follow the Drupal installation wizard
3. When prompted for database settings, use:
   - Database type: MySQL, MariaDB, Percona Server, or equivalent
   - Database name: `drupal`
   - Database username: `drupal`
   - Database password: `drupal`
   - Database host: `db`
   - Database port: `3306`

### Option 2: Using Existing Installation

If you have an existing Drupal installation with SQLite, you'll need to:

1. **Create your `.env` file:**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` with your database credentials.

2. **Copy the settings.local.php.example file (if not already done):**
   ```bash
   cp drupal/web/sites/default/settings.local.php.example drupal/web/sites/default/settings.local.php
   ```
   
   The `settings.local.php` file automatically reads database configuration from environment variables in your `.env` file. No manual editing needed!

2. **Import your database** (if you have one):
   ```bash
   docker exec -i drupal_db mysql -uroot -prootpassword drupal < your_database.sql
   ```

## Useful Commands

### View logs
```bash
docker-compose logs -f
```

### View logs for a specific service
```bash
docker-compose logs -f web
docker-compose logs -f db
```

### Stop containers
```bash
docker-compose down
```

### Stop and remove volumes (WARNING: This will delete your database)
```bash
docker-compose down -v
```

### Rebuild containers
```bash
docker-compose up -d --build
```

### Execute commands in the web container
```bash
docker exec -it drupal_web bash
```

### Execute commands in the database container
```bash
docker exec -it drupal_db mysql -uroot -prootpassword drupal
```

### Run Composer commands
```bash
docker exec -it drupal_web composer install --working-dir=/var/www/html/drupal
```

### Clear Drupal cache
```bash
docker exec -it drupal_web php /var/www/html/drupal/web/core/scripts/drupal cache:rebuild
```

## File Permissions

If you encounter permission issues, you may need to fix file permissions:

```bash
docker exec -it drupal_web chown -R www-data:www-data /var/www/html/drupal/web/sites/default/files
docker exec -it drupal_web chmod -R 755 /var/www/html/drupal/web/sites/default/files
```

## Troubleshooting

### Port already in use
If port 8080 or 3306 is already in use, edit `docker-compose.yml` and change the port mappings:
```yaml
ports:
  - "8081:80"  # Change 8080 to 8081
```

### Database connection issues
- Ensure the database container is running: `docker-compose ps`
- Check database logs: `docker-compose logs db`
- Verify database credentials in your settings.php or settings.local.php

### Permission denied errors
Run the file permissions commands listed above.

### Composer dependencies
The container automatically runs `composer install` on first startup if the vendor directory is missing. If you need to manually install or update Composer dependencies:
```bash
docker exec -it drupal_web composer install --working-dir=/var/www/html/drupal
```

**Note:** If you see an error about missing `vendor/autoload.php`, the container should automatically install dependencies on the next startup. You can also manually run the command above.

## Environment Variables

All configuration is managed through the `.env` file. Key variables:

- `DB_HOST`: Database host (default: `db` for Docker, or external IP)
- `DB_PORT`: Database port (default: `3306`)
- `DB_NAME`: Database name
- `DB_USER`: Database username
- `DB_PASSWORD`: Database password
- `DB_ROOT_PASSWORD`: MySQL root password (for prod setup)

The `settings.local.php` file automatically reads these values using `getenv()`.

## Services

- **web**: PHP 8.3 with Apache (port 8080 for prod, 20100 for local)
- **db**: MySQL 8.0 (port 3306) - only in prod setup
- **phpmyadmin**: phpMyAdmin interface (port 8081 for prod, 20101 for local)

## Production Considerations

This setup is intended for development. For production:

1. Use environment variables for sensitive data
2. Set up proper SSL/TLS certificates
3. Configure proper file permissions
4. Use a reverse proxy (nginx)
5. Set up proper backup strategies
6. Use managed database services
7. Configure proper security headers

