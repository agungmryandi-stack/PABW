<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); 
        // 5 akun petugas dummy (password semuanya: "password")
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role'     => 'petugas',
            ]);
        }
        // 1 akun admin BPBD dengan email & password tetap
        // updateOrCreate: kalau seeder dijalankan ulang, admin tidak dobel
        User::updateOrCreate(
            ['email' => 'admin@bpbd.go.id'],
            ['name' => 'Admin BPBD', 'password' => Hash::make('admin12345'), 'role' => 'admin']
        );
    }
}
