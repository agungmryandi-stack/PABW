<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function form()
    {
        return view('laporan.form');
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:100',
            'lokasi' => 'required|string|max:150',
            'tinggi' => 'required|numeric|min:1|max:500',
        ], [
            'nama.required'   => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian wajib diisi.',
            'tinggi.required' => 'Tinggi genangan wajib diisi.',
            'tinggi.numeric'  => 'Tinggi genangan harus berupa angka.',
        ]);

        return view('laporan.hasil', [
            'nama'   => $data['nama'],
            'lokasi' => $data['lokasi'],
            'tinggi' => $data['tinggi'],
            'waktu'  => now()->format('d-m-Y H:i') . ' WIB',
        ]);
    }

    public function daftar()
    {
        // Data contoh, ditulis langsung di array karena belum pakai database
        $laporan = [
            ['nama' => 'Asep Sukmawan',      'lokasi' => 'Baleendah',   'tinggi' => 20],
            ['nama' => 'Budi Santoso',  'lokasi' => 'Dayeuhkolot', 'tinggi' => 55],
            ['nama' => 'Mazhendra',   'lokasi' => 'Bojongsoang', 'tinggi' => 90],
            ['nama' => 'Udin Kasep',      'lokasi' => 'Rancaekek',   'tinggi' => 35],
        ];

        return view('laporan.daftar', compact('laporan'));
    }
}