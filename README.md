# 🕒 Sistem Pencatatan Lembur

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

<p align="center">
  <strong>🚀 Sistem Manajemen Pencatatan Lembur Berbasis Web untuk Perusahaan</strong>
</p>

## 📋 Tentang Sistem

Sistem Pencatatan Lembur adalah aplikasi web modern yang dirancang untuk mengelola dan mencatat jam lembur karyawan secara efisien. Sistem ini menyediakan platform terintegrasi untuk tracking waktu kerja, perhitungan upah lembur otomatis, dan manajemen persetujuan dengan kontrol akses berbasis role yang ketat.

### ✨ Fitur Utama

-   🕒 **Pencatatan Lembur Real-time** - Sistem tracking waktu kerja lembur karyawan
-   💰 **Perhitungan Upah Otomatis** - Kalkulasi gaji lembur berdasarkan jam kerja
-   🔐 **Sistem Role & Permission** - Kontrol akses ketat (Karyawan, HRD, Pimpinan)
-   ✅ **Workflow Persetujuan** - Sistem approval bertingkat untuk lembur
-   📊 **Dashboard Analytics** - Laporan dan statistik lembur lengkap
-   📱 **Responsive Design** - Interface modern dan mobile-friendly
-   🔔 **Notifikasi Real-time** - Alert untuk status persetujuan
-   📄 **Export Laporan** - Generate laporan PDF untuk administrasi

## 🛠️ Tech Stack

### Backend

-   **Framework**: Laravel 12.x
-   **PHP**: 8.3+
-   **Database**: MySQL 8.0+
-   **Authentication**: Laravel Breeze
-   **Authorization**: Spatie Laravel Permission
-   **PDF Generation**: Barryvdh Laravel DOMPDF

### Frontend

-   **CSS Framework**: Tailwind CSS 3.x
-   **JavaScript**: Alpine.js 3.x
-   **Icons**: Font Awesome 6.x
-   **Charts**: Chart.js 4.x
-   **Alerts**: SweetAlert2 11.x
-   **Build Tool**: Vite 7.x

### Development Tools

-   **Testing**: Pest PHP
-   **Code Quality**: Laravel Pint
-   **Package Manager**: Composer & NPM
-   **Local Development**: Laragon / XAMPP / Docker

## 📦 Paket yang Digunakan

### Composer Packages (PHP)

```json
{
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/breeze": "^2.3",
    "spatie/laravel-permission": "^6.21",
    "barryvdh/laravel-dompdf": "^3.1",
    "laravel/tinker": "^2.10.1"
}
```

### NPM Packages (JavaScript)

```json
{
    "alpinejs": "^3.4.2",
    "tailwindcss": "^3.1.0",
    "chart.js": "^4.5.0",
    "sweetalert2": "^11.23.0",
    "axios": "^1.11.0",
    "vite": "^7.0.4"
}
```

## � Persyaratan Sistem

### Minimum Requirements

-   **PHP**: 8.3 atau lebih tinggi
-   **Composer**: 2.6+
-   **Node.js**: 18.x atau lebih tinggi
-   **NPM**: 9.x atau lebih tinggi
-   **MySQL**: 8.0+
-   **Git**: 2.30+

### Recommended Development Environment

-   **Laragon** (Windows) - Full PHP development stack
-   **XAMPP** (Cross-platform) - Apache, MySQL, PHP stack
-   **Docker** - Containerized development
-   **VS Code** - Recommended code editor dengan ekstensi Laravel

### Browser Support

-   Chrome 90+
-   Firefox 88+
-   Safari 14+
-   Edge 90+

## � Panduan Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Brynnnn12/sistem-pencatatn-lembur.git
cd sistem-pencatatn-lembur
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup

```bash
# Buat database MySQL baru
# Kemudian edit file .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_lembur
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Database Migration & Seeding

```bash
# Jalankan migration
php artisan migrate

# (Opsional) Seed data dummy
php artisan db:seed
```

### 7. Build Assets

```bash
# Untuk development
npm run dev

# Untuk production
npm run build
```

### 8. Storage Link (untuk file uploads)

```bash
php artisan storage:link
```

### 9. Jalankan Aplikasi

```bash
# Menggunakan Laravel development server
php artisan serve

# Atau menggunakan Laragon/XAMPP built-in server
```

## ⚙️ Konfigurasi Aplikasi

### Environment Variables (.env)

```env
APP_NAME="Sistem Pencatatan Lembur"
APP_ENV=local
APP_KEY=base64_generated_key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_lembur
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (untuk notifikasi)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Permission Setup

```bash
# Set proper permissions untuk storage dan bootstrap/cache
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Untuk Windows (menggunakan Git Bash atau WSL)
# Biasanya sudah benar secara default
```

## 👥 Sistem Role & Permission

### Role yang Tersedia

1. **Karyawan** - User biasa yang dapat mencatat lembur
2. **HRD** - Human Resource yang mengelola data karyawan dan departemen
3. **Pimpinan** - Management yang menyetujui lembur dan melihat laporan

### Permission Matrix

| Fitur                | Karyawan | HRD | Pimpinan |
| -------------------- | -------- | --- | -------- |
| Lihat Dashboard      | ✅       | ✅  | ✅       |
| Catat Lembur         | ✅       | ✅  | ❌       |
| Lihat Lembur Sendiri | ✅       | ✅  | ❌       |
| Approve Lembur       | ❌       | ✅  | ✅       |
| Kelola Karyawan      | ❌       | ✅  | ❌       |
| Kelola Departemen    | ❌       | ✅  | ❌       |
| Kelola Jabatan       | ❌       | ✅  | ❌       |
| Lihat Semua Lembur   | ❌       | ✅  | ✅       |
| Generate Laporan     | ❌       | ✅  | ✅       |
| Lihat Statistik      | ❌       | ✅  | ✅       |

## 📊 Struktur Database

### Tabel Utama

-   **users** - Data pengguna sistem
-   **departemen** - Data departemen perusahaan
-   **jabatan** - Data jabatan karyawan
-   **karyawan** - Data karyawan lengkap
-   **catatan_lembur** - Record lembur karyawan
-   **persetujuan** - Status approval lembur
-   **upah** - Data perhitungan gaji lembur

### Relasi Database

```
users (1) ──── (1) karyawan
karyawan (N) ──── (1) departemen
karyawan (N) ──── (1) jabatan
karyawan (1) ──── (N) catatan_lembur
catatan_lembur (1) ──── (1) persetujuan
catatan_lembur (1) ──── (1) upah
```

## 🎯 Cara Penggunaan

### Untuk Karyawan

1. **Login** ke sistem menggunakan akun karyawan
2. **Akses Dashboard** untuk melihat ringkasan lembur
3. **Catat Lembur** melalui menu "Catatan Lembur"
4. **Isi Form** dengan detail jam kerja lembur
5. **Submit** dan tunggu approval dari atasan

### Untuk HRD

1. **Login** dengan akun HRD
2. **Kelola Data Master** (Departemen, Jabatan, Karyawan)
3. **Approve Lembur** yang diajukan karyawan
4. **Generate Laporan** untuk management
5. **Monitoring** performa lembur karyawan

### Untuk Pimpinan

1. **Login** dengan akun Pimpinan
2. **Review Dashboard** untuk overview perusahaan
3. **Approve Lembur** dengan authority tertinggi
4. **Akses Laporan** lengkap dan statistik
5. **Monitoring** distribusi karyawan per departemen

## 🧪 Testing

### Menjalankan Tests

```bash
# Jalankan semua test
php artisan test

# Jalankan test dengan coverage
php artisan test --coverage

# Jalankan specific test file
php artisan test tests/Feature/KaryawanTest.php
```

### Test Database

```bash
# Gunakan database testing
php artisan test --env=testing
```

## 📚 API Documentation

Sistem ini menggunakan RESTful API untuk beberapa endpoint internal:

### Authentication Endpoints

-   `POST /login` - Login user
-   `POST /logout` - Logout user
-   `POST /register` - Register user (disabled untuk production)

### Resource Endpoints

-   `GET /dashboard/departemen` - List departemen
-   `GET /dashboard/karyawan` - List karyawan
-   `GET /dashboard/catatan-lembur` - List catatan lembur
-   `POST /dashboard/persetujuan/{id}/update-status` - Update status persetujuan

## � Troubleshooting

### Common Issues

#### 1. Permission Denied

```bash
# Fix storage permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

#### 2. Database Connection Error

```bash
# Check .env database configuration
# Ensure MySQL service is running
# Create database manually if needed
```

#### 3. Assets Not Loading

```bash
# Clear cache and rebuild assets
php artisan view:clear
php artisan config:clear
npm run build
```

#### 4. Composer Memory Limit

```bash
# Increase memory limit
php -d memory_limit=-1 /usr/local/bin/composer install
```

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Development Guidelines

-   Follow PSR-12 coding standards
-   Use meaningful commit messages
-   Write tests for new features
-   Update documentation as needed
-   Ensure code passes all tests

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

## 👨‍💻 Developer

**Brynnnn12**

-   GitHub: [@Brynnnn12](https://github.com/Brynnnn12)
-   Email: brynnnn12@example.com

## 🙏 Acknowledgments

-   [Laravel](https://laravel.com/) - The PHP Framework
-   [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
-   [Alpine.js](https://alpinejs.dev/) - Minimal JavaScript framework
-   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) - Role & permission management
-   [Chart.js](https://www.chartjs.org/) - Simple yet flexible charts
-   [SweetAlert2](https://sweetalert2.github.io/) - Beautiful alerts

---

<p align="center">
  <strong>⭐ Jika Anda merasa terbantu dengan project ini, jangan lupa untuk memberikan star!</strong>
</p>
