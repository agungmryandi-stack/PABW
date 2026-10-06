<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun demo admin
        User::create([
            'name'     => 'Administrator WeBandoo+',
            'email'    => 'admin@webandoo.test',
            'password' => Hash::make('admin123'),
        ]);

        // Urutan penting: induk dulu, baru anak
        $this->call([
            KategoriSeeder::class,
            LokasiSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}