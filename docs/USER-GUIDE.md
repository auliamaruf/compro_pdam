# 👨‍💻 Panduan Penggunaan - Admin Panel

## 📋 Pendahuluan

Panduan lengkap penggunaan Admin Panel website PDAM Tirta Perwira Purbalingga yang dibangun dengan **Filament PHP**. Admin panel ini menyediakan interface yang user-friendly untuk mengelola seluruh konten website.

---

## 🔐 Akses Admin Panel

### 🌐 URL Akses
```
https://your-domain.com/admin
```

### 👤 Login Pertama Kali

#### Membuat User Admin
```bash
# Via terminal server
php artisan make:filament-user

# Input yang diperlukan:
Name: Your Name
Email: admin@pdampurbalingga.co.id
Password: [secure_password]
```

#### Reset Password (Jika Lupa)
```bash
# Reset password via artisan
php artisan tinker
> $user = App\Models\User::where('email', 'admin@example.com')->first();
> $user->password = Hash::make('new_password');
> $user->save();
```

---

## 👥 User Management & Roles

### 🎭 Role Structure

#### 🔑 Super Admin
**Full Access ke seluruh sistem**
- ✅ User management
- ✅ System settings
- ✅ All content management
- ✅ Security configurations
- ✅ Database operations

#### 👨‍💼 Content Manager
**Fokus pada pengelolaan konten**
- ✅ News & Articles
- ✅ Services management
- ✅ Pages management
- ✅ Media library
- ✅ Comments & feedback
- ❌ User management
- ❌ System settings

#### 🔧 Operator
**Operasional harian**
- ✅ View content
- ✅ Manage complaints
- ✅ Manage comments
- ✅ Basic reporting
- ❌ Create/Edit major content
- ❌ System configurations

#### 👀 Viewer
**Read-only access**
- ✅ View all content
- ✅ View reports
- ✅ Download data
- ❌ Edit any content
- ❌ System access

### 👤 Mengelola User

#### Membuat User Baru
1. **Admin Panel** → **Users** → **Create**
2. **Fill Information**:
   ```
   Name: John Doe
   Email: john@pdampurbalingga.co.id
   Password: [Auto-generated or manual]
   Roles: [Select appropriate role(s) - menggunakan Spatie Permission]
   ```
3. **Save** user

#### Edit User Information
1. **Users** → **Select User** → **Edit**
2. **Update Information**: Name, email, roles
3. **Change Password**: Optional password reset
4. **Manage Roles**: Assign/remove roles using Spatie Permission system
5. **Save Changes**

#### Deactivate User
1. **Users** → **Select User** → **Edit**
2. **Toggle Active Status**: Disable user access
3. **Save Changes**

---

## 📝 Content Management

### 📰 News & Articles Management

#### Membuat Berita Baru
1. **Admin Panel** → **Konten Website** → **Berita & Artikel**
2. **Create New Article**:

**Basic Information**:
```
Judul: Berita Terbaru PDAM
Slug: berita-terbaru-pdam (auto-generated)
Kategori: News/Announcement/Event
Status: Draft/Published
Tanggal Publish: [Set date]
```

**Content**:
```
Summary: Ringkasan berita dalam 1-2 kalimat
Content: [Rich text editor dengan full formatting]
```

**Media**:
```
Featured Image: Upload gambar utama (1200x630px recommended)
Gallery Images: Upload multiple images
```

**SEO Settings**:
```
Meta Title: [Auto dari judul atau custom]
Meta Description: [160 karakter max]
Keywords: berita, pdam, purbalingga
```

3. **Publish** artikel

#### Upload & Manage Images
1. **Drag & Drop**: Upload gambar langsung ke editor
2. **Image Optimization**: Auto-resize dan compress
3. **Alt Text**: Tambahkan deskripsi untuk SEO
4. **Gallery Management**: Arrange multiple images

#### Content Editor Features
- **Rich Text Editor**: Full WYSIWYG editing
- **Media Insert**: Images, videos, files
- **Table Creation**: Data tables dengan styling
- **Code Blocks**: Syntax highlighting
- **Links Management**: Internal dan external links
- **Typography**: Heading styles, lists, quotes

### 🛠️ Services Management

#### Menambah Layanan Baru
1. **Admin Panel** → **Konten Website** → **Layanan PDAM**
2. **Create Service**:

**Service Information**:
```
Nama Layanan: Sambungan Baru
Slug: sambungan-baru
Kategori: New Connection/Customer Service/Technical/Billing/Other
Deskripsi: Layanan pemasangan sambungan air baru
```

**Service Details**:
```
Prosedur: [Step-by-step process]
Persyaratan: [Requirements list]
Waktu Proses: 3-5 hari kerja
Biaya: Rp 500,000
Penanggung Jawab: John Doe
No. Telepon: 0281-891234
```

**Media & Documents**:
```
Icon Layanan: Upload icon/logo service
Gambar Layanan: Multiple service images
Formulir: Upload PDF/DOC forms
Link Formulir: External form links
```

**Navbar Configuration**:
```
☑️ Tampilkan di Navbar
☑️ Unggulan di Navbar
Urutan: 1
Label Navbar: [Custom label]
Icon Navbar: fas fa-wrench
```

3. **Save Service**

#### Bulk Operations
1. **Select Multiple Services**: Checkbox selection
2. **Bulk Actions**:
   - Add to Navbar
   - Remove from Navbar
   - Change Status
   - Export Data

### 📄 Pages Management

#### Membuat Halaman Statis
1. **Admin Panel** → **Konten Website** → **Halaman**
2. **Create Page**:

**Page Information**:
```
Judul: Tentang Kami
Slug: tentang-kami
Template: Default/Custom
Status: Published
```

**Content**:
```
Content: [Full page content dengan rich editor]
Excerpt: [Optional page summary]
```

**SEO & Meta**:
```
Meta Title: Tentang PDAM Tirta Perwira
Meta Description: Profil dan sejarah PDAM Purbalingga
Keywords: pdam, profil, sejarah, purbalingga
```

3. **Publish Page**

### 🎯 Hero Banner Management

#### Membuat Banner Slideshow
1. **Admin Panel** → **Konten Website** → **Hero Banner**
2. **Create Banner**:

**Banner Content**:
```
Judul: Selamat Datang di PDAM Tirta Perwira
Subtitle: Melayani dengan Hati untuk Air Bersih Berkualitas
CTA Text: Pelajari Layanan
CTA Link: /layanan
```

**Media**:
```
Background Image: 1920x1080px (recommended)
Mobile Image: 768x1024px (optional)
```

**Display Settings**:
```
Status: Active
Urutan: 1 (drag & drop untuk reorder)
Tanggal Mulai: [Start date]
Tanggal Berakhir: [End date]
```

3. **Save Banner**

#### Banner Best Practices
- **Image Size**: 1920x1080px minimum
- **File Format**: JPG/PNG (WebP recommended)
- **File Size**: < 500KB setelah optimasi
- **Text Overlay**: Kontras yang baik dengan background
- **Mobile Responsive**: Test di berbagai device

---

## 🏢 Company Settings

### 🏭 Company Profile

#### Basic Information
1. **Admin Panel** → **Pengaturan** → **Pengaturan Perusahaan**
2. **Company Details**:
```
Nama Perusahaan: PDAM Tirta perwira Purbalingga
Deskripsi: [Company description]
Tentang Kami: [About us content]
```

**Contact Information**:
```
Alamat: Jl. Letjen S. Parman No. 53, Purbalingga
Telepon: (0281) 891234
Email: info@pdampurbalingga.co.id
Website: https://pdampurbalingga.co.id
```

**Operational Hours**:
```
Hari Kerja: Senin - Jumat
Jam Kerja: 08:00 - 16:00 WIB
Jam Istirahat: 12:00 - 13:00 WIB
```

#### Media Assets
```
Logo Utama: Upload logo (PNG/SVG, 500x200px)
Logo Alt: Alternative logo untuk dark background
Favicon: 32x32px ICO/PNG
```

#### Social Media Links
```
Facebook: https://facebook.com/pdampurbalingga
Instagram: https://instagram.com/pdam_purbalingga
Twitter: https://twitter.com/pdam_purbalingga
YouTube: https://youtube.com/c/pdampurbalingga
```

### 🔍 SEO Configuration

#### Global SEO Settings
1. **Admin Panel** → **Pengaturan** → **SEO**
2. **Meta Tags**:
```
Site Title: PDAM Tirta Perwira Purbalingga
Meta Description: Perusahaan Daerah Air Minum melayani masyarakat Purbalingga dengan air bersih berkualitas
Keywords: pdam, air bersih, purbalingga, tirta perwira
```

**Open Graph Settings**:
```
OG Title: PDAM Tirta Perwira Purbalingga
OG Description: [Same as meta description]
OG Image: 1200x630px image
OG Type: website
```

**Analytics**:
```
Google Analytics ID: GA-XXXXXXXXX
Google Search Console: [Verification code]
Google Tag Manager: GTM-XXXXXXX
```

#### Page-specific SEO
- **Auto-generation**: SEO tags dari content
- **Custom Override**: Manual SEO untuk page tertentu
- **Schema Markup**: Structured data untuk rich snippets

---

## 💬 Communication Management

### 📞 Pengaduan Online

#### View & Manage Complaints
1. **Admin Panel** → **Komunikasi & Layanan** → **Pengaduan Online**
2. **Complaint List Features**:
   - **Filter by Status**: New, In Progress, Resolved, Closed
   - **Filter by Type**: Service, Technical, Billing, Other
   - **Search**: By name, email, or subject
   - **Sort**: By date, status, priority

#### Respond to Complaints
1. **Select Complaint** → **View Details**
2. **Response Form**:
```
Response Message: [Your response]
Status Update: In Progress/Resolved/Closed
Internal Notes: [Private notes for staff]
Assignee: [Assign to staff member]
Priority: Low/Medium/High/Urgent
```
3. **Send Response**

#### Bulk Operations
```
- Change Status (bulk)
- Export to Excel/PDF
- Assign to Multiple Staff
- Send Template Responses
```

### 💬 Comments Management

#### Comment Moderation
1. **Admin Panel** → **Komunikasi & Layanan** → **Komentar**
2. **Moderation Actions**:
   - **Approve**: Allow comment to show
   - **Reject**: Hide comment from public
   - **Spam**: Mark as spam
   - **Reply**: Respond to comment

#### Auto-moderation Settings
```
☑️ Auto-approve comments from registered users
☑️ Require moderation for first-time commenters
☑️ Enable spam filtering
☑️ Block comments with profanity
```

### 📧 Contact Messages

#### Manage Contact Form Submissions
1. **Admin Panel** → **Komunikasi & Layanan** → **Pesan Kontak**
2. **Message Management**:
   - **Read/Unread Status**: Mark messages
   - **Reply via Email**: Direct email response
   - **Archive**: Move to archived messages
   - **Export**: Download message data

---

## 📊 Reports & Analytics

### 📈 Built-in Reports

#### Content Statistics
```
- Total Articles: 150
- Published This Month: 12
- Popular Articles: Top 10 by views
- Comment Statistics: Engagement metrics
```

#### User Activity
```
- Active Users: Currently logged in
- Recent Activities: Latest admin actions
- Login History: User access logs
- Failed Login Attempts: Security monitoring
```

#### System Health
```
- Storage Usage: File storage statistics
- Database Size: Table sizes and growth
- Cache Performance: Hit/miss ratios
- Error Logs: System errors and warnings
```

### 🔍 Google Analytics Integration

#### Setup Analytics
1. **Company Settings** → **Analytics**
2. **Add Tracking Code**:
```javascript
// Google Analytics 4
gtag('config', 'GA-XXXXXXXXX');
```

#### View Analytics in Admin
- **Page Views**: Top visited pages
- **User Demographics**: Visitor statistics
- **Traffic Sources**: How users find the site
- **Real-time Data**: Current visitors

---

## ⚙️ System Settings

### 🧭 Navigation Menu Management

#### Configure Main Menu
1. **Admin Panel** → **Pengaturan** → **Menu Navigasi**
2. **Menu Items**:
```
Label: Beranda
URL: /
Type: Internal Link
Order: 1
Parent: [None/Parent Menu]
Icon: fas fa-home
```

#### Dropdown Menus
```
Parent: Tentang Kami
  - Child: Profil Perusahaan (/tentang)
  - Child: Sejarah (/tentang/sejarah)
  - Child: Visi Misi (/tentang/visi-misi)
```

#### Dynamic Service Menu
- **Auto-populate**: Services marked "Show in Navbar"
- **Custom Order**: Drag & drop reordering
- **Featured Services**: Highlighted menu items

### 💰 Water Tariff Management

#### Configure Tariff Structure
1. **Admin Panel** → **Pengaturan** → **Tarif Air**
2. **Tariff Categories**:
```
Kategori: Rumah Tangga
Blok 1: 0-10 m³ = Rp 2,500/m³
Blok 2: 11-20 m³ = Rp 3,000/m³
Blok 3: >20 m³ = Rp 3,500/m³
```

#### Additional Fees
```
Beban Tetap: Rp 15,000
Denda Keterlambatan: 2% per bulan
Biaya Administrasi: Rp 2,500
```

### 🏢 Branch Management

#### Add New Branch
1. **Admin Panel** → **Profil Perusahaan** → **Cabang**
2. **Branch Information**:
```
Nama Cabang: Cabang Purbalingga Timur
Alamat: Jl. Raya Timur No. 123
Telepon: (0281) 123456
Email: timur@pdampurbalingga.co.id
Kepala Cabang: John Doe
```

**Service Area**:
```
Wilayah Layanan: Kecamatan A, B, C
Coverage Map: [Upload area map]
```

### 👥 Organization Structure

#### Manage Organizational Chart
1. **Admin Panel** → **Profil Perusahaan** → **Struktur Organisasi**
2. **Position Hierarchy**:
```
Level 1: Direktur Utama
Level 2: Direktur Teknik, Direktur Keuangan
Level 3: Manager Distribusi, Manager SDM
Level 4: Supervisor Area, Staff
```

**Employee Details**:
```
Nama: John Doe
Jabatan: Manager Distribusi
Foto: [Upload photo]
Email: john@pdampurbalingga.co.id
Bio: [Optional biography]
```

---

## 🔧 Advanced Features

### 📱 Mobile App Integration

#### API Endpoints
```
GET /api/news - Latest news
GET /api/services - Service list
POST /api/complaints - Submit complaint
GET /api/tariffs - Water tariff info
```

#### API Authentication
```php
// Generate API token
$user = User::find(1);
$token = $user->createToken('Mobile App')->plainTextToken;
```

### 🔄 Data Import/Export

#### Import Data
1. **Bulk Import** → **Choose File** (CSV/Excel)
2. **Map Fields**: Match columns with database fields
3. **Validate Data**: Check for errors
4. **Import**: Process and save data

#### Export Options
```
- PDF Reports
- Excel Spreadsheets
- CSV Data Files
- JSON API Data
```

### 🔍 Search & Filtering

#### Global Search
- **Content Search**: Search across all content types
- **Advanced Filters**: Date range, category, status
- **Saved Searches**: Save frequently used searches

#### Content Filtering
```
- By Category
- By Date Range
- By Author
- By Status
- By Popularity
```

---

## 🛡️ Security & Maintenance

### 🔐 Security Features

#### User Security
```
- Two-Factor Authentication (2FA)
- Strong Password Requirements
- Account Lockout after failed attempts
- Session Management
```

#### Data Protection
```
- CSRF Protection
- XSS Prevention
- SQL Injection Protection
- File Upload Validation
```

### 🧹 Maintenance Tasks

#### Daily Tasks
```bash
# Clear expired cache
php artisan cache:prune-stale-tags

# Clean old activity logs
php artisan activitylog:clean --days=30

# Optimize database
php artisan db:optimize
```

#### Weekly Tasks
```bash
# Update search index
php artisan scout:import

# Generate sitemap
php artisan sitemap:generate

# Security scan
php artisan security:check
```

---

## 📱 Mobile Responsiveness

### 📱 Admin Panel Mobile Access

#### Mobile Features
- **Responsive Design**: Works on all screen sizes
- **Touch-Friendly**: Optimized for touch interaction
- **Quick Actions**: Swipe gestures for common tasks
- **Offline Viewing**: Basic content access offline

#### Mobile Best Practices
1. **Use WiFi**: For large file uploads
2. **Landscape Mode**: Better for complex forms
3. **Regular Sync**: Ensure data synchronization
4. **Battery Saver**: Minimize background activity

---

## 🆘 Troubleshooting

### 🚨 Common Issues

#### Can't Access Admin Panel
**Solutions**:
1. Check URL: `https://domain.com/admin`
2. Clear browser cache
3. Try incognito mode
4. Reset password: `php artisan make:filament-user`

#### Upload Errors
**Solutions**:
1. Check file size limits
2. Verify file permissions
3. Check disk space
4. Clear temporary files

#### Slow Performance
**Solutions**:
1. Clear application cache
2. Optimize database
3. Check server resources
4. Enable caching

### 📞 Getting Help

#### Support Channels
- **Documentation**: Read relevant docs
- **Community**: Join Filament Discord
- **Email Support**: tech@pdampurbalingga.co.id
- **Phone Support**: (0281) 891234

---

## 📚 Additional Resources

### 🎓 Training Materials
- [Video Tutorials](./video-tutorials/)
- [PDF Guides](./pdf-guides/)
- [Webinar Recordings](./webinars/)

### 🔗 Useful Links
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Documentation](https://laravel.com/docs)
- [TailwindCSS Documentation](https://tailwindcss.com/docs)

### 📋 Checklists
- [Daily Admin Tasks](./checklists/daily-tasks.md)
- [Content Publishing](./checklists/content-publishing.md)
- [Security Review](./checklists/security-review.md)

---

**Last Updated**: January 31, 2025  
**Document Version**: 1.0  
**Admin Panel Version**: Filament 3.3
