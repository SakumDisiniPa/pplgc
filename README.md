# 🌐 Website Kelas — Laravel Project

Selamat datang di repositori **Website Kelas PPLGC**!  
Proyek ini dibuat menggunakan framework **Laravel**, dan berfungsi sebagai pusat informasi digital untuk kelas — mencakup informasi siswa, guru, dokumentasi, forum diskusi, dan berita/pengumuman.

## 🔗 Demo Online

🖥️ Coba langsung: [https://pplgc-production.up.railway.app/](https://pplgc-production.up.railway.app/)

## 📦 Fitur Utama

- 📘 **Informasi Kelas** — Menampilkan struktur organisasi, wali kelas, dan guru mata pelajaran.
- 🖼️ **Galeri Dokumentasi** — Upload & lihat dokumentasi foto kegiatan.
- 📢 **Pengumuman dan Berita** — Admin dapat menulis berita dan info penting.
- 💬 **Forum Diskusi** — Tempat siswa berdiskusi, tanya jawab, atau curhat.
- 🔐 **Sistem Admin** — Akses khusus untuk mengelola konten dan data.

## 🚀 Teknologi yang Digunakan

- **Laravel** 10+
- **PHP** 8.1+
- **MySQL / SQLite**
- **TailwindCSS** (opsional)
- **Railway.app** untuk hosting

## ⚙️ Instalasi Lokal

```bash
git clone https://github.com/SakumDisiniPa/pplgc.git
cd pplgc

# Install dependencies
composer install

# Copy dan sesuaikan file .env
cp .env.example .env

# Generate key & migrasi
php artisan key:generate
touch database/database.sqlite
php artisan migrate

# Jalankan server lokal
php artisan serve
