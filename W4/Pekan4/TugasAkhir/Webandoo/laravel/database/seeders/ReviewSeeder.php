<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use App\Models\Review;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $lokasiIds = Lokasi::pluck('id');
        $userIds = User::pluck('id');

        $komentar = [
            'Tempatnya bagus dan bersih, pasti balik lagi.',
            'Harga masuk akal, pelayanannya ramah.',
            'Lumayan ramai di akhir pekan, sebaiknya datang pagi.',
            'Cocok untuk keluarga, anak-anak senang di sini.',
            'Suasananya enak buat foto-foto dan nongkrong.',
            'Biasa saja, tapi lokasinya mudah dijangkau.',
        ];

        for ($i = 0; $i < 40; $i++) {
            Review::create([
                'lokasi_id'         => $lokasiIds->random(),
                'user_id'           => $faker->boolean(30) ? $userIds->random() : null,
                'nama_pengunjung'   => $faker->name,
                'rating'            => $faker->numberBetween(3, 5),
                'tanggal_kunjungan' => $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
                'komentar'          => $faker->randomElement($komentar),
            ]);
        }
    }
}