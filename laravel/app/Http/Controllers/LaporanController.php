<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan halaman form
    public function form()
    {
        return view('laporan.form');
    }

    // Memproses data dari form
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
            'tinggi.min'      => 'Tinggi genangan minimal 1 cm.',
            'tinggi.max'      => 'Tinggi genangan maksimal 500 cm.',
        ]);

        $tinggi = $data['tinggi'];
        if ($tinggi <= 30) {
            $status = 'Waspada';
        } elseif ($tinggi <= 100) {
            $status = 'Siaga';
        } else {
            $status = 'Awas';
        }

        return view('laporan.hasil', [
            'nama'   => $data['nama'],
            'lokasi' => $data['lokasi'],
            'tinggi' => $tinggi,
            'status' => $status,
            'waktu'  => now()->format('d-m-Y H:i') . ' WIB',
        ]);
    }
}