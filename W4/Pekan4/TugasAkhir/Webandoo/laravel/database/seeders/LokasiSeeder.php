<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Lokasi;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kategori = Kategori::all();

        // Awalan nama tempat sesuai kategori
        $awalan = [
            'sejarah'     => ['Museum', 'Gedung', 'Monumen'],
            'spotfoto'    => ['Jalan', 'Taman Lampion', 'Spot'],
            'kafe'        => ['Kopi', 'Kafe', 'Kedai'],
            'kuliner'     => ['Batagor', 'Warung', 'Baso Tahu', 'Mie Kocok'],
            'ruangpublik' => ['Taman', 'Lapangan', 'Alun-alun'],
            'event'       => ['Festival', 'Pasar Kreatif', 'Pameran'],
            'hiddengem'   => ['Gang', 'Sudut', 'Lorong'],
        ];

        $deskripsi = [
            'Tempat yang nyaman dikunjungi bersama keluarga maupun teman.',
            'Populer di kalangan mahasiswa dan wisatawan lokal.',
            'Suasananya asri dan cocok untuk bersantai sambil berfoto.',
            'Harganya terjangkau dengan pelayanan yang ramah.',
            'Salah satu tempat favorit warga Bandung di akhir pekan.',
        ];

        for ($i = 0; $i < 20; $i++) {
            $kat = $kategori->random();

            Lokasi::create([
                'kategori_id' => $kat->id,
                'nama'        => $faker->randomElement($awalan[$kat->slug]) . ' ' . $faker->unique()->lastName,
                'lat'         => $faker->randomFloat(7, -6.95, -6.88),
                'lng'         => $faker->randomFloat(7, 107.57, 107.66),
                'gambar'      => $faker->randomElement(['bdg1.jpg', 'bdg2.jpg', 'bdg3.jpg', 'bdg4.jpg', 'bdg5.jpg', 'bdg6.jpg']),
                'alamat'      => $faker->streetAddress . ', Bandung',
                'deskripsi'   => $faker->randomElement($deskripsi),
                'tiket'       => $faker->randomElement(['Gratis', 'Rp5.000', 'Rp15.000', 'Rp25.000']),
                'jam_buka'    => $faker->randomElement(['08.00 - 16.00', '09.00 - 21.00', '10.00 - 22.00', '24 jam']),
                'biaya'       => $faker->randomElement(['Rp0 - Rp25.000', 'Rp25.000 - Rp60.000', 'Rp35.000 - Rp80.000']),
                'rating'      => $faker->randomFloat(1, 3.5, 5),
            ]);
        }
    }
}