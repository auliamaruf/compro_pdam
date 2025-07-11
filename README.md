# Kompro PDAM Tirta Perwira Purbalingga

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://php.net)
[![Filament](https://img.shields.io/badge/Filament-3.3-yellow.svg)](https://filamentphp.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-green.svg)](https://tailwindcss.com)

Website company profile modern untuk PDAM Tirta Perwira Purbalingga yang dikembangkan dengan Laravel 12 dan Filament Admin Panel.

## 🚀 Fitur Utama

### Frontend
- 🏠 **Beranda** dengan hero banner dinamis
- ℹ️ **Tentang Kami** (sejarah, visi misi, struktur organisasi)
- 🏢 **Cabang & Unit IKK** (5 cabang + 3 unit IKK)
- ⚙️ **Layanan** PDAM yang tersedia
- 📰 **Berita** terkini
- 📞 **Kontak** dan pengaduan online
- 💰 **Tarif Air** yang berlaku

### Admin Panel (Filament)
- 👥 **Manajemen User** dan roles
- 🖼️ **Hero Banner** management
- 📝 **Konten Dinamis** (sejarah perusahaan)
- 🏢 **Manajemen Cabang** dengan Unit IKK
- 👔 **Struktur Organisasi** dengan kepala cabang/unit
- 📰 **Berita** dan artikel
- ⚙️ **Pengaturan Website** dan SEO
- 📋 **Pesan Kontak** dan pengaduan

## 🛠️ Teknologi

- **Backend:** Laravel 12.x, PHP 8.3
- **Frontend:** Blade Templates, Tailwind CSS 4.x
- **Admin Panel:** Filament v3.3
- **Database:** MySQL
- **Build Tools:** Vite
- **Authentication:** Laravel Sanctum

## 📋 Prasyarat

- PHP >= 8.3
- Composer
- MySQL/MariaDB
- Node.js >= 18.x
- NPM/Yarn

## ⚡ Quick Start

### 1. Clone & Install
```bash
git clone [repository-url]
cd compro_tirtaperwira
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdam_tirta_perwira
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Migration & Seeding
```bash
php artisan migrate:fresh --seed
```

### 5. Storage Link & Build
```bash
php artisan storage:link
npm run build
```

### 6. Start Development Server
```bash
php artisan serve
```

Akses:
- **Frontend:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin

## 👤 Default Admin Login
- **Email:** admin@pdamtirtaperwira.com
- **Password:** password123

## 📂 Struktur Proyek

```
app/
├── Filament/Resources/     # Admin panel resources
├── Http/Controllers/       # Web controllers
├── Models/                 # Eloquent models
├── View/Components/        # Blade components
└── Support/               # Helper classes

resources/
├── views/                 # Blade templates
├── css/                   # Styling files
└── js/                    # JavaScript files

database/
├── migrations/            # Database migrations
└── seeders/              # Data seeders

public/
├── storage/              # Symlinked storage
├── images/               # Static images
└── build/                # Built assets
```

## 🗄️ Database Models

### Core Models
- **User** - Sistem pengguna dan admin
- **CompanySetting** - Pengaturan perusahaan
- **HeroBanner** - Banner beranda
- **Branch** - Cabang dan Unit IKK
- **OrganizationStructure** - Struktur organisasi
- **News** - Berita dan artikel
- **Service** - Layanan PDAM
- **ContactMessage** - Pesan kontak
- **OnlineComplaint** - Pengaduan online

### Fitur Branch & Unit IKK
- 5 Cabang: Bobotsari, Karangmoncol, Kemangkon, Kertanegara, Kutasari
- 3 Unit IKK: Kaligondang, Pengadegan, Rembang
- Setiap cabang/unit memiliki kepala yang ditugaskan

## 🔧 Development Commands

```bash
# Database refresh
php artisan migrate:fresh --seed

# Clear cache
php artisan optimize:clear

# Run tests
php artisan test

# Build assets
npm run dev          # Development
npm run build        # Production

# Code quality
./vendor/bin/phpstan analyse    # Static analysis
./vendor/bin/pint              # Code formatting
```

## 📱 Responsive Design

Website sepenuhnya responsif dengan dukungan:
- 📱 Mobile (320px+)
- 📟 Tablet (768px+)
- 🖥️ Desktop (1024px+)
- 🖥️ Large screens (1440px+)

## 🔒 Keamanan

- 🔐 CSRF Protection untuk semua form
- 🚪 Authentication untuk admin panel
- 🛠️ Input Validation dan sanitization
- 🔒 Secure Headers untuk keamanan
- 🚫 XSS Protection built-in Laravel

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/`:
- [Deployment Guide](docs/deployment/)
- [Technical Reports](docs/reports/)
- [API Documentation](docs/api/)

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lengkap.

## 📞 Support

Untuk pertanyaan teknis atau support:
- 📧 **Email:** workspace.auliamaruf@gmail.com

---

<p align="center">
    <strong>Dibuat dengan ❤️ untuk PDAM Tirta Perwira Purbalingga</strong>
</p>
