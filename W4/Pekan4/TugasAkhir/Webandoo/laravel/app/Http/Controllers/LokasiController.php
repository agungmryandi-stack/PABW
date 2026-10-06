<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Review;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function beranda()
    {
        return view('beranda', [
            'totalLokasi'   => Lokasi::count(),
            'totalReview'   => Review::count(),
            'totalKategori' => Kategori::count(),
            'kategori'      => Kategori::withCount('lokasi')->get(),
            'terbaik'       => Lokasi::with('kategori')->orderByDesc('rating')->take(3)->get(),
        ]);
    }

    public function index(Request $request)
    {
        $query = Lokasi::with('kategori')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn ($q) => $q->where('slug', $request->kategori));
        }

        return view('lokasi.index', [
            'lokasi'   => $query->orderByDesc('rating')->get(),
            'kategori' => Kategori::all(),
            'aktif'    => $request->kategori,
        ]);
    }

    public function show(Lokasi $lokasi)
    {
        $lokasi->load(['kategori', 'reviews' => fn ($q) => $q->latest('tanggal_kunjungan')]);

        return view('lokasi.show', ['lokasi' => $lokasi]);
    }
}