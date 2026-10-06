<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Sejarah',      'slug' => 'sejarah',     'icon' => 'fa-landmark',       'warna' => '#1abc9c'],
            ['nama' => 'Spot Foto',    'slug' => 'spotfoto',    'icon' => 'fa-camera-retro',   'warna' => '#e84393'],
            ['nama' => 'Kafe',         'slug' => 'kafe',        'icon' => 'fa-coffee',         'warna' => '#3498db'],
            ['nama' => 'Kuliner',      'slug' => 'kuliner',     'icon' => 'fa-utensils',       'warna' => '#e67e22'],
            ['nama' => 'Ruang Publik', 'slug' => 'ruangpublik', 'icon' => 'fa-tree',           'warna' => '#2ecc71'],
            ['nama' => 'Event',        'slug' => 'event',       'icon' => 'fa-calendar-check', 'warna' => '#9b59b6'],
            ['nama' => 'Hidden Gem',   'slug' => 'hiddengem',   'icon' => 'fa-gem',            'warna' => '#f1c40f'],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}