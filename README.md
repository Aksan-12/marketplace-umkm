<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Marketplace UMKM

![TBM Logo](market-place/public/images/tbm.png)

Marketplace UMKM adalah sebuah platform e-commerce yang dirancang untuk membantu para pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) dalam memasarkan produk-produk mereka secara online. Aplikasi ini dibangun menggunakan framework Laravel dengan antarmuka yang modern dan responsif.

---

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur](#fitur)
- [Dibangun Dengan](#dibangun-dengan)
- [Memulai](#memulai)
- [Lisensi](#lisensi)
- [Kontak](#kontak)

---

## Tentang Proyek

Proyek ini bertujuan untuk menyediakan sebuah platform digital yang mudah digunakan bagi para penjual (UMKM) untuk mengelola produk mereka dan bagi pembeli untuk menemukan dan membeli produk-produk lokal berkualitas. Dengan adanya tiga peran pengguna (pembeli, penjual, dan admin), platform ini memastikan manajemen yang terstruktur dan efisien.

---

## Fitur

- **Autentikasi Pengguna**: Sistem registrasi dan login yang aman untuk semua pengguna.
- **Manajemen Profil**: Pengguna dapat memperbarui informasi profil dan kata sandi mereka.
- **Peran Pengguna**: Tiga jenis peran dengan hak akses yang berbeda:
    - **Pembeli**: Dapat menjelajahi produk, menambahkan ke keranjang, melakukan checkout, dan melihat riwayat pesanan.
    - **Penjual**: Dapat mengelola produk mereka (tambah, edit, hapus) dan melihat pesanan yang masuk.
    - **Admin**: Memiliki akses penuh untuk mengelola pesanan dan memantau aktivitas di platform.
- **Manajemen Produk**: Penjual dapat dengan mudah menambahkan, memperbarui, dan menghapus produk mereka melalui dashboard yang intuitif.
- **Keranjang Belanja**: Fitur keranjang belanja yang fungsional, memungkinkan pembeli untuk menambah, memperbarui jumlah, dan menghapus produk.
- **Proses Checkout**: Alur checkout yang sederhana untuk menyelesaikan transaksi.
- **Riwayat Pesanan**: Pengguna dapat melihat riwayat pesanan mereka beserta statusnya.
- **Desain Responsif**: Tampilan yang dioptimalkan untuk berbagai perangkat, baik desktop maupun mobile.

---

## Dibangun Dengan

- [Laravel](https://laravel.com/) - Framework PHP yang digunakan sebagai basis utama.
- [Tailwind CSS](https://tailwindcss.com/) - Kerangka kerja CSS untuk desain antarmuka.
- [Alpine.js](https://alpinejs.dev/) - Kerangka kerja JavaScript minimalis.
- [MySQL](https://www.mysql.com/) - Sistem manajemen basis data.
- [Vite](https://vitejs.dev/) - Alat bantu modern untuk pengembangan frontend.

---

## Memulai

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut.

### Prasyarat

- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (misalnya MySQL)

### Instalasi

1.  **Clone repositori**
    ```sh
    git clone [https://github.com/aksan-12/marketplace-umkm.git](https://github.com/aksan-12/marketplace-umkm.git)
    cd marketplace-umkm
    ```
2.  **Instal dependensi PHP**
    ```sh
    composer install
    ```
3.  **Instal dependensi Node.js**
    ```sh
    npm install
    ```
4.  **Buat file `.env`**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```sh
    cp .env.example .env
    ```
5.  **Generate kunci aplikasi**
    ```sh
    php artisan key:generate
    ```
6.  **Jalankan migrasi database**
    ```sh
    php artisan migrate
    ```
7.  **Jalankan server pengembangan**
    ```sh
    npm run dev
    ```
    Dan di terminal lain:
    ```sh
    php artisan serve
    ```

---

## Lisensi

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE` untuk informasi lebih lanjut.

---

## Kontak

Aksan - [Linkedin](https://www.linkedin.com/in/aksan-null-7834a3311/)

Project Link: [https://github.com/aksan-12/marketplace-umkm](https://github.com/aksan-12/marketplace-umkm)
