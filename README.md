# Aplikasi CRUD Kontak - Laravel 8 dengan AJAX

Aplikasi CRUD sederhana untuk manajemen data kontak menggunakan Laravel 8 dan AJAX tanpa reload halaman.

## Tech Stack

- PHP 7.4
- Laravel 8
- MySQL
- Bootstrap 5
- jQuery
- SweetAlert2
- Font Awesome

## Fitur

- ✅ Create: Tambah data kontak baru dengan validasi
- ✅ Read: Tampilkan data dalam tabel dengan pagination
- ✅ Update: Edit data kontak yang sudah ada
- ✅ Delete: Hapus data dengan konfirmasi SweetAlert2
- ✅ Semua operasi menggunakan AJAX (tanpa reload halaman)
- ✅ Notifikasi sukses/error setelah setiap operasi
- ✅ Loading indicator saat proses AJAX
- ✅ Responsive design dengan Bootstrap 5

## Database Structure

**Database:** `laravel_crud_ajax`

**Tabel:** `contacts`

| Field | Type | Constraints |
|-------|------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT |
| name | VARCHAR(100) | NOT NULL |
| date_of_birth | DATE | NOT NULL |
| phone | VARCHAR(20) | NOT NULL |
| email | VARCHAR(100) | NOT NULL, UNIQUE |
| address | TEXT | NOT NULL |
| created_at | TIMESTAMP | NULL |
| updated_at | TIMESTAMP | NULL |

## Validasi Form

- **Name**: Required, maksimal 100 karakter
- **Date of Birth**: Required, format date, tidak boleh tanggal masa depan
- **Phone**: Required, numeric, 10-15 digit
- **Email**: Required, format email valid, unique
- **Address**: Required, maksimal 500 karakter

## Instalasi & Konfigurasi

### 1. Install Dependencies

```bash
cd laravel_crud_ajax
composer install
```

### 2. Konfigurasi Environment

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud_ajax
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Buat Database

Buat database MySQL dengan nama `laravel_crud_ajax`:

```sql
CREATE DATABASE laravel_crud_ajax;
```

Atau jika menggunakan command line:

```bash
mysql -u root -p -e "CREATE DATABASE laravel_crud_ajax;"
```

### 4. Jalankan Migration

```bash
php artisan migrate
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di browser: `http://localhost:8000`

## Struktur File

```
laravel_crud_ajax/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ContactController.php    # Controller untuk CRUD operations
│   └── Models/
│       └── Contact.php                   # Model Contact
├── database/
│   └── migrations/
│       └── 2026_01_06_074418_create_contacts_table.php
├── resources/
│   └── views/
│       └── contacts/
│           └── index.blade.php           # View utama dengan AJAX
├── routes/
│   └── web.php                           # Routes definition
└── .env                                  # Environment configuration
```

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` atau `/contacts` | Tampilkan halaman utama / list kontak (AJAX) |
| POST | `/contacts` | Simpan kontak baru |
| GET | `/contacts/{id}/edit` | Ambil data kontak untuk edit |
| PUT/PATCH | `/contacts/{id}` | Update kontak |
| DELETE | `/contacts/{id}` | Hapus kontak |

## Cara Penggunaan

### 1. Tambah Kontak Baru
- Klik tombol "Tambah Kontak"
- Isi form dengan data yang valid
- Klik "Simpan"
- Data akan tersimpan tanpa reload halaman

### 2. Edit Kontak
- Klik tombol "Edit" (icon pensil) pada data yang ingin diubah
- Ubah data yang diperlukan
- Klik "Simpan"
- Data akan terupdate tanpa reload halaman

### 3. Hapus Kontak
- Klik tombol "Hapus" (icon tempat sampah) pada data yang ingin dihapus
- Konfirmasi penghapusan pada dialog SweetAlert2
- Data akan terhapus tanpa reload halaman

### 4. Navigasi Pagination
- Klik nomor halaman atau tombol Previous/Next
- Data akan berganti tanpa reload halaman

## Screenshot Fitur

- ✨ Desain modern dengan gradient color
- 📱 Responsive untuk semua ukuran layar
- 🎨 Bootstrap 5 untuk styling
- 🔔 SweetAlert2 untuk notifikasi
- ⏳ Loading overlay saat proses AJAX
- ✅ Validasi form real-time

## Testing

Untuk testing manual:

1. **Test Create:**
   - Tambah data dengan field kosong → harus ada error validasi
   - Tambah data dengan email duplikat → harus ada error unique
   - Tambah data dengan tanggal masa depan → harus ada error validasi
   - Tambah data valid → harus berhasil tersimpan

2. **Test Read:**
   - Cek pagination berfungsi
   - Cek data tampil dengan benar

3. **Test Update:**
   - Edit data dan simpan → harus berhasil update
   - Edit dengan email yang sudah ada (kecuali email sendiri) → harus error

4. **Test Delete:**
   - Hapus data → harus muncul konfirmasi
   - Konfirmasi hapus → data terhapus

## Troubleshooting

### Error: Access denied for user 'root'
Pastikan username dan password database di file `.env` sudah benar.

### Error: Database doesn't exist
Buat database terlebih dahulu:
```bash
mysql -u root -p -e "CREATE DATABASE laravel_crud_ajax;"
```

### Error: Class not found
Jalankan:
```bash
composer dump-autoload
```

### Error: Application key not set
Jalankan:
```bash
php artisan key:generate
```

## Catatan Penting

- Aplikasi ini menggunakan AJAX untuk semua operasi CRUD
- Tidak ada full page reload saat melakukan operasi
- Validasi dilakukan di backend (Laravel)
- Error ditampilkan secara real-time di form
- SweetAlert2 digunakan untuk konfirmasi dan notifikasi

## Lisensi

Open Source - Bebas digunakan untuk pembelajaran.

---

Dibuat dengan ❤️ menggunakan Laravel 8
