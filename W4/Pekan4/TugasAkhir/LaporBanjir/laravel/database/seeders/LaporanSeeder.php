<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kecamatan = ['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('laporan')->insert([
                'nama_pelapor'     => $faker->name,
                'lokasi'           => $faker->randomElement($kecamatan),
                'tinggi_genangan'  => $faker->numberBetween(10, 150),
                'tanggal_kejadian' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}