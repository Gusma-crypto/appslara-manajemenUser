# Appslara - Manajemen User

Appslara adalah aplikasi manajemen user berbasis Laravel yang menyediakan sistem autentikasi, otorisasi (berbasis role), dan manajemen pengguna secara dinamis. Dibuat dengan Laravel Breeze, Spatie Laravel-Permission, dan TailwindCSS.
## Sc
![Manajemen User]('1.png');
![Setting Mail]('2.png');
## ✨ Fitur

- Autentikasi menggunakan Laravel Breeze (Login, Register)
- Role & Permission:
  - Superadmin
  - Admin
  - User
- Manajemen User:
  - Tambah, Edit, Hapus User
  - Atur Role User
  - Blokir / Aktifkan User
- Notifikasi (success/error) dengan Alpine.js
- Navigasi dinamis berdasarkan role
- Pengaturan email SMTP (Mailtrap/Gmail)
- Konfirmasi email via token (opsional)
- Konfigurasi setting via database (admin-only)

---

## 🔧 Instalasi

### 1. Clone Project

```bash
git clone https://github.com/Gusma-crypto/appslara-manajemenUser.git
cd appslara
```

### 2. Install Dependency

```bash
composer install
npm install && npm run build
```

### 3. Setup `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuai konfigurasi lokal:

```env
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Appslara"
```

### 4. Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
```

Seeder akan membuat:
- Superadmin: `superadmin@example.com` / `password`
- Admin: `admin@example.com` / `password`
- User: `user@example.com` / `password`

---

## 🚀 Jalankan Aplikasi

```bash
php artisan serve
```

Akses: [http://localhost:8000](http://localhost:8000)

---

## 🧰 Tech Stack

- Laravel 10
- Laravel Breeze
- TailwindCSS
- Spatie Laravel Permission
- Alpine.js

---

## 📁 Struktur Folder Utama

```bash
app/
├── Http/
│   ├── Controllers/
│   │   └── Superadmin/
│   │       └── UserManagementController.php
├── Models/
│   └── User.php
resources/
├── views/
│   ├── superadmin/
│   │   └── users.blade.php
routes/
└── web.php
```

---

## 🛡️ Hak Akses

| Role        | Akses                         |
|-------------|-------------------------------|
| Superadmin  | Semua fitur & pengaturan      |
| Admin       | Kelola user (terbatas)        |
| User        | Akses halaman dashboard umum  |

---

## 🙏 Kontribusi

Pull request sangat diterima. Untuk fitur, issue, atau laporan bug silakan buat issue terlebih dahulu.

---

## 📝 Lisensi

Appslara adalah open-source dan dirilis di bawah [MIT License](LICENSE).
