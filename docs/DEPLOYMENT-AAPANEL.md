# 🚀 Panduan Deployment - aaPanel

## 📋 Pendahuluan

Panduan ini khusus untuk deployment website PDAM Tirta Perwira Purbalingga di hosting menggunakan **aaPanel**. aaPanel adalah control panel gratis yang populer untuk server Linux.

---

## 🏗️ Persiapan Server

### 🖥️ Spesifikasi Minimum
- **OS**: Ubuntu 20.04+ / CentOS 8+
- **RAM**: 2GB (4GB recommended)
- **Storage**: 20GB SSD
- **CPU**: 2 Core
- **Bandwidth**: Unlimited

### 📦 Software Requirements
- **Web Server**: Nginx 1.18+ atau Apache 2.4+
- **PHP**: 8.1+ (8.2 recommended)
- **Database**: MySQL 8.0+ atau MariaDB 10.4+
- **Node.js**: 18.x LTS
- **Composer**: Latest version

---

## 🔧 Instalasi aaPanel

### 1. Install aaPanel
```bash
# Ubuntu/Debian
wget -O install.sh http://www.aapanel.com/script/install-ubuntu_6.0_en.sh && sudo bash install.sh aapanel

# CentOS
yum install -y wget && wget -O install.sh http://www.aapanel.com/script/install_6.0_en.sh && sh install.sh aapanel
```

### 2. Akses aaPanel
- **URL**: `http://your-server-ip:8888`
- **Username/Password**: Ditampilkan setelah instalasi

### 3. Install Environment
Di aaPanel, install:
- **Nginx** 1.20+
- **PHP** 8.2
- **MySQL** 8.0
- **phpMyAdmin** (optional)
- **Node.js** 18.x

---

## 📂 Struktur Deployment

### 🗂️ Directory Structure
```
/www/wwwroot/your-domain.com/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          ← Document Root
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
└── deploy-aapanel.sh
```

### ⚙️ aaPanel Website Settings
1. **Document Root**: Set ke `public/` folder
2. **PHP Version**: 8.2
3. **SSL**: Enable jika menggunakan HTTPS
4. **Rewrite**: Enable URL rewrite

---

## 🚀 Step-by-Step Deployment

### 1. 📤 Upload Files

#### Via File Manager
1. Login ke aaPanel
2. **File** → Buka folder website
3. Upload semua files project (kecuali `node_modules`, `.git`)

#### Via Git (Recommended)
```bash
# SSH ke server
ssh root@your-server-ip

# Navigate ke direktori website
cd /www/wwwroot/your-domain.com

# Clone repository
git clone https://github.com/your-repo/compro_pdam.git .

# Atau upload manual dan extract
```

### 2. 🗄️ Database Setup

#### Create Database
1. **Database** → **Add Database**
2. **Database Name**: `compro_pdam`
3. **Username**: `pdam_user`
4. **Password**: `secure_password`

#### MySQL Configuration (Optional)
```sql
-- Optimize MySQL for Laravel
SET GLOBAL innodb_file_per_table = 1;
SET GLOBAL innodb_buffer_pool_size = 1073741824; -- 1GB
```

### 3. ⚙️ Environment Configuration

#### Create .env File
```bash
# Via Terminal aaPanel
cd /www/wwwroot/your-domain.com
cp .env.template .env
nano .env
```

#### Critical Settings
```env
APP_NAME="PDAM Tirta Perwira Purbalingga"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=compro_pdam
DB_USERNAME=pdam_user
DB_PASSWORD=secure_password

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=587
MAIL_FROM_ADDRESS="noreply@your-domain.com"
```

### 4. 🔧 Run Deployment Script

#### Make Script Executable
```bash
chmod +x deploy-aapanel.sh
```

#### Execute Deployment
```bash
./deploy-aapanel.sh
```

**Script akan melakukan:**
- ✅ Install Composer dependencies
- ✅ Generate application key
- ✅ Build frontend assets
- ✅ Run database migrations
- ✅ Create storage symlink
- ✅ Set proper permissions
- ✅ Cache configurations

### 5. 🔍 Manual Verification

#### Check Essential Files
```bash
# Verify build assets
ls -la public/build/

# Check storage link
ls -la public/storage

# Test database connection
php artisan tinker
> DB::connection()->getPdo();
```

#### Test Website Access
1. Browse to your domain
2. Check homepage loads correctly
3. Test admin panel: `/admin`
4. Verify CSS/JS loading

---

## 🔐 Security Configuration

### 🛡️ SSL Certificate

#### Free SSL (Let's Encrypt)
1. **SSL** → **Let's Encrypt**
2. Enter domain name
3. **Apply** certificate

#### Custom SSL
1. **SSL** → **Other Certificate**
2. Upload certificate files
3. **Deploy** certificate

### 🔒 Security Headers
Headers sudah dikonfigurasi di `SecurityHeadersMiddleware.php`:
- Content Security Policy (CSP)
- X-Frame-Options
- X-Content-Type-Options
- HSTS (untuk HTTPS)

### 🚫 Firewall Rules
```bash
# aaPanel Firewall
# Allow: 80, 443, 8888 (aaPanel), 22 (SSH)
# Block: All other ports
```

---

## ⚡ Performance Optimization

### 🗄️ Database Optimization

#### MySQL Tuning
```sql
-- Add to MySQL configuration
[mysqld]
innodb_file_per_table = 1
innodb_buffer_pool_size = 1G
max_connections = 300
query_cache_size = 64M
```

#### Laravel Optimization
```bash
# Production caching
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Clear development cache
php artisan optimize:clear
```

### 🌐 Web Server Optimization

#### Nginx Configuration
```nginx
# Add to site config
location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff2?)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
    access_log off;
}

# Gzip compression
gzip on;
gzip_vary on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml text/javascript;
```

### 📊 Monitoring

#### aaPanel Monitoring
- **Monitor** → **System Load**
- **Monitor** → **Network**
- **Monitor** → **Process**

#### Application Monitoring
```bash
# Monitor Laravel logs
tail -f storage/logs/laravel.log

# Check PHP errors
tail -f /www/server/php/82/var/log/php-fpm.log
```

---

## 🔄 Maintenance & Updates

### 📅 Regular Maintenance

#### Daily Tasks
```bash
# Backup database
php artisan backup:run

# Clean old logs
find storage/logs/ -name "*.log" -mtime +30 -delete

# Optimize database
php artisan db:optimize
```

#### Weekly Tasks
```bash
# Update dependencies
composer update --no-dev

# Clear old cache
php artisan cache:clear
php artisan view:clear

# Check security updates
composer audit
```

### 🔄 Application Updates

#### Git-based Updates
```bash
# Backup current version
cp -r /www/wwwroot/domain.com /www/backup/domain-$(date +%Y%m%d)

# Pull updates
git pull origin main

# Run update script
./deploy-aapanel.sh
```

#### Manual Updates
1. **Backup** current installation
2. **Upload** new files
3. **Run** deployment script
4. **Test** functionality

---

## 🆘 Troubleshooting

### 🚨 Common Issues

#### 1. CSS/JS Not Loading
**Symptoms**: Website tampil tanpa styling

**Solutions**:
```bash
# Check build assets
ls -la public/build/

# Rebuild assets
npm install
npm run build

# Check storage link
php artisan storage:link

# Clear cache
php artisan view:clear
php artisan config:clear
```

#### 2. Database Connection Error
**Symptoms**: Error database connection

**Solutions**:
1. Verify `.env` database settings
2. Check MySQL service status
3. Test connection:
```bash
mysql -u pdam_user -p compro_pdam
```

#### 3. Permission Denied
**Symptoms**: File permission errors

**Solutions**:
```bash
# Fix Laravel permissions
sudo chown -R www:www storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache
```

#### 4. 500 Internal Server Error
**Symptoms**: HTTP 500 error

**Solutions**:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check PHP error logs in aaPanel
3. Enable debug temporarily:
```env
APP_DEBUG=true
```
4. Check web server error logs

#### 5. Admin Panel Not Accessible
**Symptoms**: Can't access `/admin`

**Solutions**:
```bash
# Create admin user
php artisan make:filament-user

# Clear Filament cache
php artisan filament:cache-components

# Check route cache
php artisan route:clear
```

### 📱 Contact Support
- **aaPanel Documentation**: [bt.cn](https://www.bt.cn/bbs/forum-39-1.html)
- **Laravel Documentation**: [laravel.com/docs](https://laravel.com/docs)
- **Filament Documentation**: [filamentphp.com/docs](https://filamentphp.com/docs)

---

## ✅ Post-Deployment Checklist

### 🔍 Verification Steps
- [ ] Website accessible via domain
- [ ] Homepage loads correctly
- [ ] CSS/JS files loading
- [ ] Images displaying properly
- [ ] Admin panel accessible
- [ ] Database connection working
- [ ] Email functionality tested
- [ ] SSL certificate active
- [ ] Security headers present
- [ ] Performance optimized

### 📊 Performance Checks
- [ ] Page load speed < 3 seconds
- [ ] Mobile responsiveness
- [ ] SEO meta tags present
- [ ] Sitemap accessible
- [ ] Analytics tracking active

### 🔒 Security Verification
- [ ] Admin panel secured
- [ ] File permissions correct
- [ ] Backup system active
- [ ] Monitoring configured
- [ ] Updates scheduled

---

## 📞 Support & Resources

### 🆘 Emergency Contacts
- **System Administrator**: admin@pdampurbalingga.co.id
- **Technical Support**: tech@pdampurbalingga.co.id
- **Emergency Phone**: +62 281 891234

### 📚 Documentation Links
- [User Guide](./USER-GUIDE.md)
- [API Documentation](./API-DOCS.md)
- [Security Guide](./SECURITY.md)
- [Backup Guide](./BACKUP.md)

### 🔧 Useful Commands
```bash
# Check system status
php artisan about

# View application logs
tail -f storage/logs/laravel.log

# Monitor server resources
htop

# Check PHP configuration
php -i | grep -i memory

# Test email configuration
php artisan tinker
> Mail::raw('Test email', function($msg) { $msg->to('test@example.com')->subject('Test'); });
```

---

**Last Updated**: January 31, 2025  
**Document Version**: 1.0  
**Supported aaPanel Version**: 6.8+
