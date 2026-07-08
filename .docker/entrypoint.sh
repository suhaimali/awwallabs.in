#!/bin/sh
set -e

# Ensure storage and bootstrap/cache permissions are correct
chown -R www-data:www-data /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

# If .env does not exist, copy from .env.example
if [ ! -f "/app/.env" ]; then
    echo "Creating .env from .env.example..."
    cp /app/.env.example /app/.env
    # Generate app key if not set
    php artisan key:generate --force
fi

# Run storage:link safely
php artisan storage:link --force || true

# Wait for MySQL to be ready before running migrations
echo "Waiting for database connection..."
max_attempts=30
attempt=1
until php -r "try { new PDO('mysql:host='.getenv('DB_HOST').';port='.getenv('DB_PORT').';dbname='.getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }" > /dev/null 2>&1 || [ $attempt -gt $max_attempts ]; do
    echo "Database is not ready yet (attempt $attempt/$max_attempts)..."
    sleep 2
    attempt=$((attempt+1))
done

if [ $attempt -gt $max_attempts ]; then
    echo "Database connection timed out. Proceeding anyway..."
else
    echo "Database is ready! Running migrations..."
    php artisan migrate --force
    
    # Run seeders if RUN_SEEDERS is set to true
    if [ "$RUN_SEEDERS" = "true" ]; then
        echo "Running database seeders..."
        php artisan db:seed --force
    fi
fi

# Optimizing Laravel for production
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Setup cron task to run scheduler every minute as www-data
echo "Setting up crontab..."
echo "* * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1" > /var/spool/cron/crontabs/www-data
chmod 0600 /var/spool/cron/crontabs/www-data

# Execute supervisor to start nginx, php-fpm, and cron
echo "Starting Supervisor..."
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
