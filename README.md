# 🌊 Website Company Profile PDAM Tirta Perwira

<p align="center">
    <img src="public/images/logo-tirta-perwira.png" width="200" alt="PDAM Tirta Perwira Logo">
</p>

<p align="center">
    <strong>Website Company Profile Resmi PDAM Tirta Perwira Purbalingga</strong><br>
    Dibangun dengan Laravel 11 + Tailwind CSS + Filament Admin Panel
</p>

---

## 📖 Tentang Proyek

Website company profile modern untuk **PDAM Tirta Perwira Purbalingga** yang menyediakan informasi lengkap mengenai layanan air bersih, berita terkini, profil perusahaan, dan layanan pelanggan online.

### ✨ Fitur Utama

- 🏠 **Homepage Dinamis** dengan hero carousel dan quick actions
- 📰 **Sistem Berita** dengan kategorisasi dan pencarian
- 💼 **Profil Perusahaan** lengkap dengan visi, misi, dan sejarah
- 🛠️ **Layanan Online** untuk pelanggan (info tarif, pengaduan, dll)
- 📞 **Sistem Kontak** dan lokasi kantor
- 📱 **Responsive Design** untuk semua device
- 🔧 **Admin Panel** dengan Filament untuk manajemen konten

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Tailwind CSS v4 (Latest)
- **Admin Panel:** Filament v3.3
- **Database:** MySQL
- **Icons:** Heroicons
- **Build Tool:** Vite
- **Deployment:** Ready for production

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Node.js 18+
- MySQL 8.0+
- Composer

### 1. Clone Repository
```bash
git clone [repository-url]
cd compro_tirtaperwira
```

### 2. Install Dependencies
```bash
# PHP Dependencies
composer install

# Node.js Dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdam_tirtaperwira
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 5. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 6. Start Development Server
```bash
php artisan serve
```

---

## 🔐 Admin Panel Access

- **URL:** `/admin`
- **Default Credentials:** (Create admin user via seeder)

### Admin Features
- 📄 **Manajemen Halaman** (Pages Management)
- 📰 **Manajemen Berita** (News Management)
- 🛠️ **Manajemen Layanan** (Services Management)
- 📸 **Media Gallery** dengan kategori
- ⚙️ **Pengaturan Perusahaan** (Company Settings)
- 💬 **Pesan Kontak** (Contact Messages)
- 📋 **Pengaduan Online** (Online Complaints)
- 🧭 **Menu Navigasi** (Navigation Menus)

---

## 🌐 Website Structure

```
┌─ Homepage
├─ Profil Perusahaan
│  ├─ Tentang Kami
│  ├─ Visi & Misi
│  ├─ Sejarah
│  └─ Struktur Organisasi
├─ Layanan
│  ├─ Layanan Air Bersih
│  ├─ Tarif Air
│  └─ Layanan Online
├─ Berita & Informasi
│  ├─ Berita Terbaru
│  ├─ Pengumuman
│  └─ Galeri
├─ Kontak
│  ├─ Informasi Kontak
│  ├─ Lokasi
│  └─ Form Pengaduan
└─ Admin Panel (/admin)
```

---

## 📱 Responsive Design

Website telah dioptimasi untuk berbagai ukuran layar:
- 📱 **Mobile** (320px - 768px)
- 📱 **Tablet** (768px - 1024px)
- 💻 **Desktop** (1024px+)

---

## 🔧 Development

### Key Commands
```bash
# Start development server
php artisan serve

# Watch for file changes
npm run dev

# Run migrations
php artisan migrate

# Clear all cache
php artisan optimize:clear

# Build for production
npm run build
```

### Code Style
- Ikuti standar kode Laravel
- Gunakan utilitas Tailwind CSS
- Beri komentar pada logika kompleks
- Tulis pesan commit yang deskriptif

---

## 📊 Performance

- ⚡ **Optimized Images** dengan lazy loading
- 🎯 **Minimal JavaScript** untuk performa maksimal
- 📦 **Asset Bundling** dengan Vite
- 🗄️ **Database Indexing** untuk query cepat
- 🔄 **Caching Strategy** untuk konten statis

---

## 🛡️ Security

- 🔐 **CSRF Protection** untuk semua form
- 🚪 **Authentication** untuk admin panel
- 🛠️ **Input Validation** dan sanitization
- 🔒 **Secure Headers** untuk keamanan
- 🚫 **XSS Protection** built-in Laravel

---

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

---

## 📝 License

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lengkap.

---

## 📞 Support

Untuk pertanyaan teknis atau support:
- 📧 **Email:** workspace.auliamaruf@gmail.com

---

## 📋 Changelog

### v2.0.0 (Juni 2025)
- ✅ Refactor lengkap dengan Laravel 12
- ✅ UI/UX modern dengan Tailwind CSS v4
- ✅ Admin panel dengan Filament v3
- ✅ Responsive design yang lebih baik
- ✅ Performance optimization
- ✅ Security improvements

### v1.0.0 (Awal)
- 🎉 Website pertama kali diluncurkan

---

<p align="center">
    <strong>Dibuat dengan ❤️ untuk PDAM Tirta Perwira Purbalingga</strong>
</p>
