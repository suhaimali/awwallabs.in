#!/bin/bash
# =====================================================
# AWWAL LAB — Server Deployment Script
# =====================================================

set -e

# Change to project root directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )"
cd "$SCRIPT_DIR"

echo "🚀 Starting AWWAL LAB server deployment..."

echo "📥 1. Pulling latest code from GitHub..."
git pull origin main

echo "📦 2. Installing/updating Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "⚙️ 3. Clearing and rebuilding Laravel caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔐 4. Setting folder permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

echo "♻️ 5. Restarting queue workers (if any)..."
php artisan queue:restart 2>/dev/null || true

echo "✅ Deployment completed successfully! AWWAL LAB is live."
