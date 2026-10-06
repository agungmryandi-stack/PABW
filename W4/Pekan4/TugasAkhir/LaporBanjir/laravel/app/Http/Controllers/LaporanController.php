<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Halaman beranda menampilkan ringkasan laporan
    public function beranda()
    {
        $semua = Laporan::all();

        return view('beranda', [
            'total'   => $semua->count(),
            'awas'    => $semua->where('status', 'Awas')->count(),
            'terbaru' => $semua->sortByDesc('tanggal_kejadian')->take(3),
        ]);
    }

    // Tampilkan form laporan
    public function form()
    {
        return view('form');
    }

    // Simpan laporan ke database
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelapor'     => 'required|string|max:255',
            'lokasi'           => 'required|string|max:255',
            'tinggi_genangan'  => 'required|integer|min:1|max:500',
            'tanggal_kejadian' => 'required|date|before_or_equal:today',
        ]);

        $laporan = Laporan::create([
            'nama_pelapor'     => $request->nama_pelapor,
            'lokasi'           => $request->lokasi,
            'tinggi_genangan'  => $request->tinggi_genangan,
            'tanggal_kejadian' => $request->tanggal_kejadian,
        ]);

        return view('konfirmasi', ['laporan' => $laporan]);
    }

    // Tampilkan daftar laporan dari database
        // Tampilkan daftar laporan dari database
    public function daftar()
    {
        $data = Laporan::orderByDesc('tanggal_kejadian')->get();

        return view('daftar', [
            'laporan' => $data,
            'jumlah'  => [
                'semua'   => $data->count(),
                'awas'    => $data->where('status', 'Awas')->count(),
                'siaga'   => $data->where('status', 'Siaga')->count(),
                'waspada' => $data->where('status', 'Waspada')->count(),
            ],
        ]);
    }
}