#!/bin/bash

# Universal Laravel Deployment Script
# Compatible with any hosting provider (shared hosting, VPS, dedicated server)

echo "🚀 Laravel Universal Deployment Script"
echo "======================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Check if we're in a Laravel project
if [ ! -f "artisan" ]; then
    print_error "Not a Laravel project! Please run this script from the Laravel root directory."
    exit 1
fi

# Step 1: Environment Setup
echo ""
echo "📋 Step 1: Environment Configuration"
echo "-----------------------------------"

if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        print_status ".env file created from .env.example"
    else
        print_error ".env.example not found! Please create .env manually."
        exit 1
    fi
else
    print_warning ".env file already exists, skipping creation"
fi

# Step 2: Dependencies
echo ""
echo "📦 Step 2: Installing Dependencies"
echo "--------------------------------"

if command -v composer &> /dev/null; then
    composer install --optimize-autoloader --no-dev
    print_status "Composer dependencies installed"
else
    print_error "Composer not found! Please install Composer first."
    exit 1
fi

# Step 3: Application Key
echo ""
echo "🔑 Step 3: Application Key"
echo "------------------------"

if grep -q "APP_KEY=$" .env; then
    php artisan key:generate --force
    print_status "Application key generated"
else
    print_warning "Application key already exists, skipping generation"
fi

# Step 4: Frontend Assets
echo ""
echo "🎨 Step 4: Building Frontend Assets"
echo "---------------------------------"

if [ -f "package.json" ]; then
    if command -v npm &> /dev/null; then
        npm install
        npm run build
        print_status "Frontend assets built successfully"
    else
        print_warning "npm not found! Frontend assets not built. Please install Node.js/npm and run 'npm run build' manually."
    fi
else
    print_warning "package.json not found, skipping frontend build"
fi

# Step 5: Clear Caches
echo ""
echo "🧹 Step 5: Clearing Caches"
echo "-------------------------"

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
print_status "All caches cleared"

# Step 6: Storage Link
echo ""
echo "🔗 Step 6: Storage Symbolic Link"
echo "-------------------------------"

if [ ! -L "public/storage" ]; then
    php artisan storage:link
    print_status "Storage symbolic link created"
else
    print_warning "Storage link already exists"
fi

# Step 7: Permissions
echo ""
echo "📁 Step 7: Setting Permissions"
echo "-----------------------------"

# Set directory permissions
find storage -type d -exec chmod 755 {} \; 2>/dev/null
find bootstrap/cache -type d -exec chmod 755 {} \; 2>/dev/null

# Set file permissions
find storage -type f -exec chmod 644 {} \; 2>/dev/null
find bootstrap/cache -type f -exec chmod 644 {} \; 2>/dev/null

# Try to set ownership (might fail on shared hosting)
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null && print_status "Ownership set to www-data" || print_warning "Could not set ownership (this is normal on shared hosting)"

print_status "Permissions set"

# Step 8: Production Optimizations
echo ""
echo "⚡ Step 8: Production Optimizations"
echo "---------------------------------"

# Only cache if in production environment
if grep -q "APP_ENV=production" .env; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan optimize
    print_status "Production optimizations applied"
else
    print_warning "Not in production environment, skipping optimizations"
fi

# Step 9: Final Checks
echo ""
echo "🔍 Step 9: Final Checks"
echo "---------------------"

# Check if build directory exists
if [ -d "public/build" ] && [ "$(ls -A public/build)" ]; then
    print_status "Build assets found in public/build/"
else
    print_warning "No build assets found. Make sure to run 'npm run build'"
fi

# Check storage link
if [ -L "public/storage" ]; then
    print_status "Storage link is properly configured"
else
    print_warning "Storage link missing. Run 'php artisan storage:link'"
fi

# Final Summary
echo ""
echo "🎉 Deployment Summary"
echo "===================="
print_status "Deployment script completed!"

echo ""
echo "📋 Next Steps:"
echo "1. Update .env with your database credentials"
echo "2. Set APP_ENV=production and APP_DEBUG=false in .env"
echo "3. Update APP_URL in .env to match your domain"
echo "4. Run: php artisan migrate --force"
echo "5. Ensure web server document root points to 'public/' folder"

echo ""
echo "🔧 Common Hosting Configurations:"
echo ""
echo "📌 Shared Hosting (cPanel/DirectAdmin):"
echo "   - Upload all files to root directory"
echo "   - Move public/* to public_html/"
echo "   - Update index.php paths in public_html/"
echo ""
echo "📌 VPS/Dedicated Server:"
echo "   - Set document root to /path/to/project/public"
echo "   - Configure web server (Apache/Nginx)"
echo ""
echo "📌 aaPanel/CloudPanel:"
echo "   - Set document root to 'public' folder"
echo "   - Ensure PHP version 8.1+"

echo ""
print_status "Ready for production! 🚀"
