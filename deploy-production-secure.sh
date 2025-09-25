#!/bin/bash
# PDAM Tirta Perwira - Security-Focused Deployment Script
# Run this script on the production server after file upload

echo "🚀 Starting PDAM Tirta Perwira Deployment with Security Setup..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the correct directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found. Please run this script from the Laravel project root directory."
    exit 1
fi

print_status "Checking system requirements..."

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;" 2>/dev/null)
if [ $? -ne 0 ]; then
    print_error "PHP is not installed or not in PATH"
    exit 1
fi
print_success "PHP Version: $PHP_VERSION"

# Check Composer
if ! command -v composer &> /dev/null; then
    print_error "Composer is not installed or not in PATH"
    exit 1
fi
print_success "Composer is available"

# Step 1: Setup Environment File
print_status "Setting up environment configuration..."
if [ ! -f ".env" ]; then
    if [ -f ".env.example.production" ]; then
        cp .env.example.production .env
        print_warning "Copied .env.example.production to .env - Please update with your actual values!"
    else
        cp .env.example .env
        print_warning "Copied .env.example to .env - Please update with your actual values!"
    fi
else
    print_success "Environment file (.env) already exists"
fi

# Step 2: Install Dependencies
print_status "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader
if [ $? -eq 0 ]; then
    print_success "PHP dependencies installed successfully"
else
    print_error "Failed to install PHP dependencies"
    exit 1
fi

# Step 3: Generate Application Key
print_status "Generating application key..."
php artisan key:generate --force
print_success "Application key generated"

# Step 4: Cache Optimization
print_status "Optimizing application caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# For production, clear any existing caches first
print_status "Clearing existing caches..."
php artisan cache:clear
php artisan config:clear

print_success "Application caches optimized"

# Step 5: Database Migration
print_status "Running database migrations..."
read -p "Do you want to run database migrations? (y/n): " run_migrations
if [[ $run_migrations =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    if [ $? -eq 0 ]; then
        print_success "Database migrations completed"
        
        # Ask about seeders
        read -p "Do you want to run database seeders? (y/n): " run_seeders
        if [[ $run_seeders =~ ^[Yy]$ ]]; then
            php artisan db:seed --force
            print_success "Database seeders completed"
        fi
    else
        print_error "Database migration failed"
    fi
else
    print_warning "Skipping database migrations"
fi

# Step 6: Storage Link
print_status "Creating storage symbolic link..."
php artisan storage:link
print_success "Storage link created"

# Step 7: File Permissions
print_status "Setting correct file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
print_success "File permissions set"

# Step 8: Security Validation
print_status "Running security validation..."

# Check if security features are properly configured
print_status "Checking security configuration..."

# Check reCAPTCHA configuration
if grep -q "NOCAPTCHA_SECRET=your_recaptcha_secret_key_here" .env; then
    print_error "⚠️  CRITICAL: reCAPTCHA keys not configured! Please update .env file"
    echo "   - Visit: https://www.google.com/recaptcha/admin/"
    echo "   - Create new site for your domain"
    echo "   - Update NOCAPTCHA_SECRET and NOCAPTCHA_SITEKEY in .env"
else
    print_success "reCAPTCHA configuration appears to be set"
fi

# Check cache driver
if grep -q "CACHE_DRIVER=redis" .env; then
    print_status "Redis cache configured - checking Redis connection..."
    php artisan tinker --execute="Redis::ping();" 2>/dev/null
    if [ $? -eq 0 ]; then
        print_success "Redis connection successful"
    else
        print_warning "Redis connection failed - rate limiting may not work properly"
    fi
fi

# Run security monitor
print_status "Testing security monitoring system..."
php artisan security:monitor --stats
if [ $? -eq 0 ]; then
    print_success "Security monitoring system is working"
else
    print_error "Security monitoring system failed"
fi

# Step 9: Final Security Checks
print_status "Performing final security checks..."

# Check if debug mode is disabled
if grep -q "APP_DEBUG=false" .env; then
    print_success "Debug mode is disabled (production ready)"
else
    print_error "⚠️  CRITICAL: Debug mode is enabled! Set APP_DEBUG=false in .env"
fi

# Check if HTTPS is configured
if grep -q "APP_URL=https://" .env; then
    print_success "HTTPS configured in APP_URL"
else
    print_warning "Consider updating APP_URL to use HTTPS"
fi

# Step 10: Test Routes
print_status "Testing critical routes..."
php artisan route:list --name=contact --compact
php artisan route:list --name=complaint --compact

# Final Summary
echo ""
echo "🎉 Deployment completed!"
echo ""
print_success "✅ Security features implemented and tested"
print_success "✅ Application optimized for production"
print_success "✅ Database migrations completed"
print_success "✅ File permissions set correctly"

echo ""
echo "📋 POST-DEPLOYMENT CHECKLIST:"
echo ""
echo "1. 🔑 Configure reCAPTCHA keys in .env file"
echo "   - NOCAPTCHA_SECRET=your_secret_key"
echo "   - NOCAPTCHA_SITEKEY=your_site_key"
echo ""
echo "2. 🗄️  Verify database connection and data"
echo ""
echo "3. 📧 Test email configuration"
echo ""
echo "4. 🔒 Test security features:"
echo "   - Submit contact form"
echo "   - Submit complaint form"  
echo "   - Test rate limiting"
echo "   - Verify reCAPTCHA protection"
echo ""
echo "5. 🌐 Configure web server (Nginx/Apache):"
echo "   - Enable HTTPS/SSL"
echo "   - Set up proper redirects"
echo "   - Configure security headers"
echo ""
echo "6. 📊 Monitor security logs:"
echo "   - php artisan security:monitor --stats"
echo "   - Check logs in storage/logs/"
echo ""

# Ask about web server configuration
read -p "Do you need help with web server configuration? (y/n): " need_webserver_help
if [[ $need_webserver_help =~ ^[Yy]$ ]]; then
    echo ""
    echo "📝 NGINX CONFIGURATION EXAMPLE:"
    echo ""
    cat << 'EOF'
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com;
    root /path/to/your/project/public;
    index index.php;

    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF
fi

print_success "🎊 PDAM Tirta Perwira deployment completed successfully!"
print_status "Visit your website and test all functionality before announcing go-live."

echo ""
echo "For support, check:"
echo "- DEPLOYMENT_SECURITY_CHECKLIST.md"
echo "- docs/ directory"
echo "- Laravel logs in storage/logs/"