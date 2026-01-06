<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data existing
        Contact::truncate();

        // Tambah dummy data
        $contacts = [
            [
                'name' => 'John Doe',
                'date_of_birth' => '1990-01-15',
                'phone' => '081234567890',
                'email' => 'john.doe@example.com',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat, DKI Jakarta'
            ],
            [
                'name' => 'Jane Smith',
                'date_of_birth' => '1992-05-20',
                'phone' => '082345678901',
                'email' => 'jane.smith@example.com',
                'address' => 'Jl. Sudirman No. 456, Bandung, Jawa Barat'
            ],
            [
                'name' => 'Ahmad Ibrahim',
                'date_of_birth' => '1988-03-10',
                'phone' => '083456789012',
                'email' => 'ahmad.ibrahim@example.com',
                'address' => 'Jl. Pemuda No. 789, Surabaya, Jawa Timur'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'date_of_birth' => '1995-07-25',
                'phone' => '084567890123',
                'email' => 'siti.nurhaliza@example.com',
                'address' => 'Jl. Gajah Mada No. 321, Yogyakarta, DIY'
            ],
            [
                'name' => 'Budi Santoso',
                'date_of_birth' => '1991-11-30',
                'phone' => '085678901234',
                'email' => 'budi.santoso@example.com',
                'address' => 'Jl. Ahmad Yani No. 654, Semarang, Jawa Tengah'
            ],
            [
                'name' => 'Dewi Lestari',
                'date_of_birth' => '1993-09-12',
                'phone' => '086789012345',
                'email' => 'dewi.lestari@example.com',
                'address' => 'Jl. Diponegoro No. 987, Malang, Jawa Timur'
            ],
            [
                'name' => 'Rizki Ramadhan',
                'date_of_birth' => '1989-04-18',
                'phone' => '087890123456',
                'email' => 'rizki.ramadhan@example.com',
                'address' => 'Jl. Pahlawan No. 147, Medan, Sumatera Utara'
            ],
            [
                'name' => 'Ayu Ting Ting',
                'date_of_birth' => '1994-06-20',
                'phone' => '088901234567',
                'email' => 'ayu.tingting@example.com',
                'address' => 'Jl. Hayam Wuruk No. 258, Denpasar, Bali'
            ],
            [
                'name' => 'Eko Prasetyo',
                'date_of_birth' => '1987-12-05',
                'phone' => '089012345678',
                'email' => 'eko.prasetyo@example.com',
                'address' => 'Jl. Veteran No. 369, Makassar, Sulawesi Selatan'
            ],
            [
                'name' => 'Fitri Handayani',
                'date_of_birth' => '1996-02-14',
                'phone' => '081122334455',
                'email' => 'fitri.handayani@example.com',
                'address' => 'Jl. Kartini No. 741, Palembang, Sumatera Selatan'
            ],
            [
                'name' => 'Hendra Wijaya',
                'date_of_birth' => '1990-08-22',
                'phone' => '082233445566',
                'email' => 'hendra.wijaya@example.com',
                'address' => 'Jl. Gatot Subroto No. 852, Pontianak, Kalimantan Barat'
            ],
            [
                'name' => 'Indah Permata',
                'date_of_birth' => '1992-10-28',
                'phone' => '083344556677',
                'email' => 'indah.permata@example.com',
                'address' => 'Jl. Imam Bonjol No. 963, Balikpapan, Kalimantan Timur'
            ]
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
