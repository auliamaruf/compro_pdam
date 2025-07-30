#!/bin/bash

# aaPanel Compatible Laravel Deployment Script
# Optimized for aaPanel hosting environment

echo "🚀 aaPanel Laravel Deployment"
echo "============================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
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

print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

# Get current directory
CURRENT_DIR=$(pwd)
print_info "Working directory: $CURRENT_DIR"

# Check if we're in a Laravel project
if [ ! -f "artisan" ]; then
    print_error "Not a Laravel project! Please run this script from the Laravel root directory."
    exit 1
fi

# Detect aaPanel structure
if [[ "$CURRENT_DIR" == *"/www/wwwroot/"* ]]; then
    print_info "aaPanel environment detected"
    AAPANEL_ENV=true
else
    AAPANEL_ENV=false
fi

echo ""
echo "📋 Step 1: Environment Setup"
echo "----------------------------"

# Create .env if not exists
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        print_status ".env file created from .env.example"
    elif [ -f ".env.template" ]; then
        cp .env.template .env
        print_status ".env file created from .env.template"
    else
        print_error ".env file not found! Please create it manually."
        exit 1
    fi
else
    print_warning ".env file already exists"
fi

echo ""
echo "📦 Step 2: Composer Dependencies"
echo "-------------------------------"

# Check if composer is available
if command -v composer &> /dev/null; then
    composer install --optimize-autoloader --no-dev --no-interaction
    print_status "Composer dependencies installed"
elif command -v /usr/local/bin/composer &> /dev/null; then
    /usr/local/bin/composer install --optimize-autoloader --no-dev --no-interaction
    print_status "Composer dependencies installed (using /usr/local/bin/composer)"
else
    print_error "Composer not found! Please install via aaPanel Software Store."
    print_info "Alternative: Download composer.phar and use: php composer.phar install"
fi

echo ""
echo "🔑 Step 3: Application Key"
echo "------------------------"

# Generate key if empty
if grep -q "APP_KEY=$" .env || grep -q "APP_KEY=\"\"" .env; then
    php artisan key:generate --force
    print_status "Application key generated"
else
    print_warning "Application key already exists"
fi

echo ""
echo "🎨 Step 4: Frontend Assets"
echo "-------------------------"

# Check Node.js/npm availability
if command -v npm &> /dev/null; then
    print_info "Installing npm dependencies..."
    npm install --silent
    
    print_info "Building production assets..."
    npm run build:production
    print_status "Frontend assets built successfully"
elif command -v node &> /dev/null; then
    print_warning "npm found but trying alternative build..."
    node --version
    if [ -f "package-lock.json" ]; then
        npm ci --silent
        npm run build:production
        print_status "Frontend assets built with npm ci"
    fi
else
    print_warning "Node.js/npm not found!"
    print_info "Please install Node.js via aaPanel Software Store"
    print_info "Or manually run: npm install && npm run build"
fi

echo ""
echo "🧹 Step 5: Clear All Caches"
echo "--------------------------"

php artisan config:clear
php artisan cache:clear  
php artisan route:clear
php artisan view:clear
print_status "All caches cleared"

echo ""
echo "🔗 Step 6: Storage Link"
echo "---------------------"

# Remove existing link if it's broken
if [ -L "public/storage" ] && [ ! -e "public/storage" ]; then
    rm public/storage
    print_warning "Removed broken storage link"
fi

if [ ! -L "public/storage" ]; then
    php artisan storage:link
    print_status "Storage symbolic link created"
else
    print_warning "Storage link already exists"
fi

echo ""
echo "📁 Step 7: Permissions"
echo "--------------------"

# Set storage permissions
if [ -d "storage" ]; then
    find storage -type d -exec chmod 755 {} \; 2>/dev/null
    find storage -type f -exec chmod 644 {} \; 2>/dev/null
    print_status "Storage permissions set"
fi

# Set bootstrap/cache permissions
if [ -d "bootstrap/cache" ]; then
    find bootstrap/cache -type d -exec chmod 755 {} \; 2>/dev/null
    find bootstrap/cache -type f -exec chmod 644 {} \; 2>/dev/null
    print_status "Bootstrap cache permissions set"
fi

# Try to set ownership (might not work on shared hosting)
if $AAPANEL_ENV; then
    # aaPanel typically uses www or www-data
    chown -R www:www storage bootstrap/cache 2>/dev/null || \
    chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || \
    print_warning "Could not change ownership (this is normal on some shared hosting)"
fi

echo ""
echo "⚡ Step 8: Production Optimization"
echo "--------------------------------"

# Check if production environment
if grep -q "APP_ENV=production" .env; then
    php artisan config:cache
    php artisan route:cache  
    php artisan view:cache
    php artisan optimize
    print_status "Production optimizations applied"
else
    print_warning "Not in production mode. Set APP_ENV=production in .env for optimizations"
fi

echo ""
echo "🔍 Step 9: Deployment Verification"
echo "---------------------------------"

# Check essential files/directories
if [ -f "public/index.php" ]; then
    print_status "Laravel entry point found"
else
    print_error "public/index.php missing!"
fi

if [ -d "public/build" ] && [ "$(ls -A public/build 2>/dev/null)" ]; then
    print_status "Build assets found"
else
    print_warning "Build assets missing - run 'npm run build' manually"
fi

if [ -L "public/storage" ]; then
    print_status "Storage link configured"
else
    print_warning "Storage link missing"
fi

# Check .env critical settings
echo ""
echo "📋 Environment Check:"
echo "--------------------"

if grep -q "APP_KEY=base64:" .env; then
    print_status "APP_KEY is set"
else
    print_warning "APP_KEY might not be properly set"
fi

APP_URL=$(grep "APP_URL=" .env | cut -d '=' -f2)
print_info "APP_URL: $APP_URL"

DB_DATABASE=$(grep "DB_DATABASE=" .env | cut -d '=' -f2)
print_info "Database: $DB_DATABASE"

echo ""
echo "🎉 Deployment Complete!"
echo "====================="

print_status "Laravel deployment finished successfully!"

echo ""
echo "📌 Next Steps:"
echo "1. Update .env with correct database credentials"
echo "2. Ensure APP_URL matches your domain"
echo "3. Run database migration: php artisan migrate --force"
echo "4. Set aaPanel website document root to: public/"
echo "5. Test your website!"

echo ""
echo "🔧 aaPanel Specific Notes:"
echo "• Document Root: Set to 'public' folder in website settings"
echo "• PHP Version: Ensure 8.1+ is selected"
echo "• Database: Create via aaPanel Database panel"
echo "• SSL: Enable via aaPanel SSL panel if needed"

echo ""
print_status "Ready for production! 🚀"

# Final check
if [ -f "public/index.php" ] && [ -d "vendor" ]; then
    echo ""
    print_status "🌐 Your Laravel app should now be accessible!"
    if $AAPANEL_ENV; then
        DOMAIN=$(basename "$CURRENT_DIR")
        print_info "Try accessing: http://$DOMAIN or https://$DOMAIN"
    fi
fi
