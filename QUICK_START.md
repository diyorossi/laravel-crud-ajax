# Quick Start Guide - Laravel CRUD AJAX

## 🚀 Panduan Cepat Memulai Aplikasi

### Persiapan Database

Aplikasi ini membutuhkan database MySQL. Pastikan MySQL sudah running.

#### Cara 1: Jika MySQL sudah running
```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE laravel_crud_ajax;
EXIT;
```

#### Cara 2: Jika menggunakan Docker/XAMPP/WAMP
- Buka phpMyAdmin
- Buat database baru dengan nama: `laravel_crud_ajax`

### Setup Aplikasi

1. **Masuk ke direktori project:**
```bash
cd laravel_crud_ajax
```

2. **Edit konfigurasi database di file `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud_ajax
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```
⚠️ Ganti `your_mysql_password` dengan password MySQL Anda

3. **Jalankan migration:**
```bash
php artisan migrate
```

4. **[OPTIONAL] Isi dengan data dummy:**
```bash
php artisan db:seed --class=ContactSeeder
```

5. **Jalankan aplikasi:**
```bash
php artisan serve
```

6. **Buka browser dan akses:**
```
http://localhost:8000
```

### ✅ Selesai!

Aplikasi sudah siap digunakan. Anda akan melihat:
- Halaman utama dengan tabel kontak
- Tombol "Tambah Kontak" untuk menambah data baru
- Tombol Edit (icon pensil) dan Delete (icon tempat sampah) di setiap baris data

### 🎯 Test Fitur CRUD

#### Create (Tambah Data)
1. Klik tombol "Tambah Kontak"
2. Isi semua field:
   - Nama: John Doe
   - Tanggal Lahir: 1990-01-01
   - Telepon: 081234567890
   - Email: john@test.com
   - Alamat: Jl. Test No. 123
3. Klik "Simpan"
4. Data akan muncul di tabel tanpa reload halaman

#### Read (Lihat Data)
- Data otomatis tampil di tabel
- Gunakan pagination di bawah tabel untuk navigasi

#### Update (Edit Data)
1. Klik icon pensil (tombol kuning) pada baris data
2. Ubah data yang ingin diubah
3. Klik "Simpan"
4. Data terupdate tanpa reload halaman

#### Delete (Hapus Data)
1. Klik icon tempat sampah (tombol merah) pada baris data
2. Konfirmasi penghapusan
3. Data terhapus tanpa reload halaman

### ❗ Troubleshooting Umum

**Error: Access denied for user 'root'**
- Cek password MySQL di file `.env`
- Pastikan MySQL service running

**Error: Unknown database 'laravel_crud_ajax'**
- Database belum dibuat, jalankan: `CREATE DATABASE laravel_crud_ajax;`

**Error: Nothing to migrate**
- Migration sudah jalan, tidak ada masalah

**Port 8000 sudah digunakan**
- Gunakan port lain: `php artisan serve --port=8080`

### 📚 Dokumentasi Lengkap

Lihat file `README.md` dan `INSTALLATION_GUIDE.md` untuk dokumentasi detail.

---

Happy Coding! 🎉
