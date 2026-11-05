<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->paginate(5);
        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:15',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:100',
            'tinggi_air'   => 'required|integer|min:1|max:1000',
            'keterangan'   => 'nullable|string',
            'foto'         => 'required|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        // Simpan ke storage/app/public/foto_banjir, path-nya disimpan ke database
        $validated['foto'] = $request->file('foto')->store('foto_banjir', 'public');

        Laporan::create($validated); // status otomatis "Menunggu"

        return redirect()->route('laporan.create')
            ->with('success', 'Laporan berhasil dikirim. Terima kasih, petugas akan segera memeriksa.');
    }

    // PETUGAS - detail satu laporan
    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    // PETUGAS - form edit
    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    // PETUGAS - simpan perubahan (foto baru opsional)
    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:15',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:100',
            'tinggi_air'   => 'required|integer|min:1|max:1000',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:Menunggu,Diproses,Selesai',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($laporan->foto); // hapus foto lama
            $validated['foto'] = $request->file('foto')->store('foto_banjir', 'public');
        } else {
            unset($validated['foto']); // nggak ganti foto, biarkan yang lama
        }

        $laporan->update($validated);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    // PETUGAS - hapus laporan + fotonya
    public function destroy(Laporan $laporan)
    {
        Storage::disk('public')->delete($laporan->foto);     // hapus file foto
        $laporan->delete();                                  // hapus data di database

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}