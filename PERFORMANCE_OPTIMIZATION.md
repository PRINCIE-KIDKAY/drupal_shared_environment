# Drupal Performance Optimization Guide

This document explains the performance optimizations applied to your Drupal Docker environment and provides additional recommendations.

## Issues Identified and Fixed

### 1. ✅ OPcache Configuration (FIXED)

**Problem**: OPcache settings were too conservative for Drupal's needs.

**Solution**: Optimized OPcache settings in `Dockerfile`:
- Increased memory from 128MB to 256MB
- Increased interned strings buffer from 8MB to 16MB
- Increased max accelerated files from 4,000 to 10,000
- Set `revalidate_freq=0` for better performance (checks file timestamps instead)
- Added realpath cache settings for better file system performance

### 2. ✅ Apache Configuration (FIXED)

**Problem**: Basic Apache configuration without performance optimizations.

**Solution**: Enhanced Apache configuration:
- Enabled compression (deflate) for text-based files
- Disabled directory indexing for security and performance
- Optimized file serving settings
- Added proper caching headers support

### 3. ✅ Database Configuration (FIXED)

**Problem**: No database performance optimizations.

**Solution**: Added MySQL performance settings in `settings.local.php`:
- Set transaction isolation level to READ COMMITTED (recommended for Drupal)
- Optimized PDO settings for better performance

### 4. ⚠️ Windows Docker Volume Mount Performance (ONGOING ISSUE)

**Problem**: The entire `./drupal` directory is mounted as a bind mount, which is very slow on Windows Docker.

**Current Workaround**: Only the `vendor` directory uses a named volume (faster).

**Recommendations**:
1. **Use WSL2**: If possible, use WSL2 backend for Docker Desktop instead of Hyper-V
2. **Move more directories to named volumes**: Consider moving these to named volumes:
   - `drupal/web/sites/default/files` (user uploads)
   - `drupal/web/core` (if you don't need to edit core files)
3. **Use Docker Desktop's file sharing optimization**: In Docker Desktop settings, add your project directory to the file sharing exclusion list and use named volumes instead

**Example docker-compose.yml optimization**:
```yaml
volumes:
  - ./drupal:/var/www/html/drupal
  - drupal_vendor:/var/www/html/drupal/vendor
  - drupal_files:/var/www/html/drupal/web/sites/default/files
  - drupal_config:/var/www/html/drupal/web/sites/default/config
```

## Additional Performance Recommendations

### 1. Enable Drupal Caching Modules

Ensure these modules are enabled in Drupal:
- **Internal Page Cache** (`page_cache`) - Caches pages for anonymous users
- **Dynamic Page Cache** (`dynamic_page_cache`) - Caches dynamic content
- **BigPipe** (`big_pipe`) - Improves perceived performance

To enable:
```bash
docker exec -it drupal_web drush en page_cache dynamic_page_cache big_pipe -y
```

### 2. Configure Drupal Performance Settings

In Drupal admin (`/admin/config/development/performance`):
- ✅ Enable "Aggregate CSS files"
- ✅ Enable "Aggregate JavaScript files"
- ✅ Enable "Compress CSS files"
- ✅ Enable "Compress JavaScript files"
- Set "Browser and proxy cache maximum age" to at least 1 hour (3600 seconds)

### 3. Database Optimization

Add these MySQL optimizations to your database container:

```yaml
# In docker-compose.yml, add to db service:
command: >
  --default-authentication-plugin=mysql_native_password
  --innodb_buffer_pool_size=512M
  --innodb_log_file_size=128M
  --max_connections=200
  --query_cache_type=1
  --query_cache_size=64M
```

### 4. Use Redis or Memcache for Caching (Advanced)

For even better performance, consider using Redis or Memcache for Drupal's cache backend:

1. Add Redis service to `docker-compose.yml`
2. Install Redis PHP extension
3. Configure Drupal to use Redis for caching

### 5. Enable APCu (Optional)

APCu can improve class loading performance. To enable:

1. Install APCu extension in Dockerfile:
```dockerfile
RUN docker-php-ext-install apcu
```

2. Enable in PHP configuration:
```ini
apc.enabled=1
apc.shm_size=128M
```

### 6. Monitor Performance

Use these tools to monitor performance:

- **Drupal's built-in performance reports**: `/admin/reports/status`
- **New Relic** or **Blackfire** for detailed profiling
- **Docker stats**: `docker stats` to monitor container resource usage

## Quick Performance Checklist

- [x] OPcache optimized
- [x] Apache compression enabled
- [x] Database settings optimized
- [ ] Drupal caching modules enabled
- [ ] CSS/JS aggregation enabled in Drupal
- [ ] Consider using named volumes for more directories (Windows)
- [ ] Consider Redis/Memcache for advanced caching
- [ ] Monitor resource usage with `docker stats`

## Rebuilding After Changes

After making changes to the Dockerfile:

```bash
# Rebuild the container
docker-compose -f docker-compose.prod.yml build

# Restart services
docker-compose -f docker-compose.prod.yml up -d

# Clear Drupal cache
docker exec -it drupal_web php /var/www/html/drupal/web/core/scripts/drupal cache:rebuild
```

## Expected Performance Improvements

After applying these optimizations, you should see:
- **30-50% faster page load times** (with caching enabled)
- **Reduced server load** (OPcache reduces PHP compilation overhead)
- **Better file system performance** (realpath cache)
- **Faster database queries** (optimized connection settings)

## Troubleshooting

### If pages are still slow:

1. **Check if caching is enabled**: Visit `/admin/config/development/performance`
2. **Clear all caches**: `docker exec -it drupal_web drush cr`
3. **Check OPcache status**: Create a PHP info page to verify OPcache is working
4. **Monitor database queries**: Enable query logging in MySQL
5. **Check Docker resource allocation**: Ensure Docker has enough CPU and memory

### Verify OPcache is working:

```bash
docker exec -it drupal_web php -r "var_dump(opcache_get_status());"
```

You should see `opcache_enabled => true` and memory usage statistics.

## Additional Resources

- [Drupal Performance Guide](https://www.drupal.org/docs/8/administering-a-drupal-8-site/performance)
- [Docker Performance Best Practices](https://docs.docker.com/desktop/windows/troubleshoot/#performance-issues)
- [OPcache Configuration](https://www.php.net/manual/en/opcache.configuration.php)

