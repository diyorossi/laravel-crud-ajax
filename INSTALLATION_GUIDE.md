# Panduan Instalasi & Setup

## Prerequisites

Pastikan sudah terinstall:
- PHP >= 7.4
- Composer
- MySQL >= 5.7
- Web Server (Apache/Nginx) atau PHP Development Server

## Langkah-langkah Instalasi

### Step 1: Setup Project

Jika belum punya project Laravel, buat dengan:
```bash
composer create-project --prefer-dist laravel/laravel:^8.0 laravel_crud_ajax
```

Project sudah ada? Lanjut ke step 2.

### Step 2: Install Dependencies

```bash
cd laravel_crud_ajax
composer install
```

### Step 3: Konfigurasi Environment

Copy file `.env.example` menjadi `.env` (jika belum ada):
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
APP_NAME="Laravel CRUD AJAX"
APP_ENV=local
APP_KEY=base64:xxxxx
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud_ajax
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### Step 4: Buat Database

#### Menggunakan MySQL CLI:
```bash
mysql -u root -p
```

Kemudian jalankan:
```sql
CREATE DATABASE laravel_crud_ajax;
EXIT;
```

#### Menggunakan phpMyAdmin:
1. Buka phpMyAdmin
2. Klik "New" untuk membuat database baru
3. Nama database: `laravel_crud_ajax`
4. Collation: `utf8mb4_unicode_ci`
5. Klik "Create"

### Step 5: Jalankan Migration

```bash
php artisan migrate
```

Output yang diharapkan:
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table
Migrating: 2026_01_06_074418_create_contacts_table
Migrated:  2026_01_06_074418_create_contacts_table
```

### Step 6: Verifikasi Route

Cek routes yang tersedia:
```bash
php artisan route:list
```

Pastikan ada routes berikut:
```
GET|HEAD   /                           contacts.index
GET|HEAD   contacts                    contacts.index
POST       contacts                    contacts.store
GET|HEAD   contacts/{contact}/edit     contacts.edit
PUT|PATCH  contacts/{contact}          contacts.update
DELETE     contacts/{contact}          contacts.destroy
```

### Step 7: Jalankan Development Server

```bash
php artisan serve
```

Atau jika ingin custom host dan port:
```bash
php artisan serve --host=0.0.0.0 --port=8080
```

### Step 8: Akses Aplikasi

Buka browser dan akses:
```
http://localhost:8000
```

atau

```
http://127.0.0.1:8000
```

## Troubleshooting

### 1. Error: SQLSTATE[HY000] [1045] Access denied

**Solusi:**
- Cek username dan password MySQL di file `.env`
- Pastikan MySQL service sudah running:
  ```bash
  sudo service mysql start
  ```

### 2. Error: SQLSTATE[HY000] [1049] Unknown database

**Solusi:**
- Pastikan database `laravel_crud_ajax` sudah dibuat
- Jalankan:
  ```bash
  mysql -u root -p -e "CREATE DATABASE laravel_crud_ajax;"
  ```

### 3. Error: Class 'App\Models\Contact' not found

**Solusi:**
```bash
composer dump-autoload
```

### 4. Error: No application encryption key has been specified

**Solusi:**
```bash
php artisan key:generate
```

### 5. Error: The stream or file could not be opened

**Solusi:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 6. AJAX Request Gagal / CSRF Token Mismatch

**Solusi:**
- Clear cache:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan view:clear
  ```
- Refresh browser (Ctrl+F5)

### 7. Port 8000 Already in Use

**Solusi:**
```bash
# Gunakan port lain
php artisan serve --port=8080
```

## Testing Database Connection

Test koneksi database:
```bash
php artisan tinker
```

Kemudian di tinker console:
```php
DB::connection()->getPdo();
echo "Database connected successfully!";
exit;
```

## Seeding Data (Optional)

Jika ingin menambah dummy data untuk testing:

1. Buat seeder:
```bash
php artisan make:seeder ContactSeeder
```

2. Edit file `database/seeders/ContactSeeder.php`:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'name' => 'John Doe',
            'date_of_birth' => '1990-01-15',
            'phone' => '081234567890',
            'email' => 'john@example.com',
            'address' => 'Jl. Contoh No. 123, Jakarta'
        ]);

        Contact::create([
            'name' => 'Jane Smith',
            'date_of_birth' => '1992-05-20',
            'phone' => '082345678901',
            'email' => 'jane@example.com',
            'address' => 'Jl. Sample No. 456, Bandung'
        ]);
    }
}
```

3. Jalankan seeder:
```bash
php artisan db:seed --class=ContactSeeder
```

## Production Deployment

Untuk production, jangan lupa:

1. Set environment ke production di `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize aplikasi:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. Set permission yang benar:
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Informasi Tambahan

- Laravel Documentation: https://laravel.com/docs/8.x
- Bootstrap 5 Documentation: https://getbootstrap.com/docs/5.1
- SweetAlert2 Documentation: https://sweetalert2.github.io

---

Selamat mencoba! 🚀
