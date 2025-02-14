# Perancangan Aplikasi Inventaris Berbasis Website dengan Integrasi QR Code di Laboratorium Informatika

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

## Deskripsi

Aplikasi ini dirancang untuk membantu dalam pengelolaan inventaris laboratorium informatika dengan fitur utama:
- Manajemen data inventaris (barang masuk, barang keluar, dan status barang)
- Integrasi QR Code untuk memudahkan pencatatan dan pencarian barang
- Sistem otentikasi pengguna untuk administrator dan staf
- Dashboard interaktif dengan statistik penggunaan barang

## Teknologi yang Digunakan

- [Laravel](https://laravel.com) - Framework PHP untuk pengembangan web
- MySQL - Database untuk menyimpan data inventaris
- JavaScript (Vue.js) - Untuk tampilan interaktif
- Bootstrap - Untuk desain UI yang responsif
- [Laravel QR Code](https://github.com/SimpleSoftwareIO/simple-qrcode) - Untuk pembuatan dan pemindaian QR Code

## Instalasi

1. Clone repositori:
   ```bash
   git clone https://github.com/username/repo-inventaris.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd repo-inventaris
   ```
3. Install dependensi dengan Composer:
   ```bash
   composer install
   ```
4. Copy file `.env` dan atur konfigurasi database:
   ```bash
   cp .env.example .env
   ```
5. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
6. Migrasi database:
   ```bash
   php artisan migrate --seed
   ```
7. Jalankan server:
   ```bash
   php artisan serve
   ```

## Penggunaan

1. Login ke aplikasi sebagai admin.
2. Tambahkan data inventaris dan buat QR Code untuk setiap barang.
3. Gunakan pemindai QR Code untuk mempercepat pencarian barang.
4. Pantau statistik penggunaan barang dari dashboard.

## Kontribusi

Kontribusi sangat dihargai! Silakan lakukan fork, buat branch fitur baru, dan ajukan pull request.

## Lisensi

Aplikasi ini dirilis di bawah [MIT License](https://opensource.org/licenses/MIT).

