<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan Model User Anda berada di namespace ini

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membersihkan tabel users sebelum mengisi (opsional, tapi disarankan)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Membuat user administrator pertama
        User::create([
            'name' => 'Admin Utama',
            'email' => 'ikdriyasaatkutuh@gmail.com',
            'password' => Hash::make('12345678'), // Password: 'password'
            'email_verified_at' => now(),
            // Anda bisa menambahkan kolom lain di sini jika ada, seperti 'is_admin'
        ]);

        // Opsional: Membuat user biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@primelearn.com',
            'password' => Hash::make('123456'), 
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('User admin telah dibuat: admin@primelearn.com / password');
    }
}