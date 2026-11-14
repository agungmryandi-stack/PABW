<?php

namespace Modules\Pendaftaran\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Pendaftaran\Http\Requests\DaftarRequest;
use Modules\Pendaftaran\Models\Daftar;

class PendaftaranController extends Controller
{
    /**
     * Disk dan folder tempat berkas pendaftaran disimpan.
     */
    private const DISK = 'public';
    private const FOLDER = 'berkas_pendaftaran';

    /**
     * Display the page. Data is loaded via AJAX.
     */
    public function index(): View
    {
        return view('pendaftaran::index');
    }

    /**
     * Return all registrations as JSON.
     */
    public function getData(): JsonResponse
    {
        return response()->json(Daftar::latest()->get());
    }

    /**
     * Store a newly created registration together with its uploaded file.
     */
    public function store(DaftarRequest $request): JsonResponse
    {
        $data = $request->safe()->except('berkas');
        $data += $this->storeFile($request);

        Daftar::create($data);

        return response()->json(['success' => 'Data berhasil disimpan.']);
    }

    /**
     * Return a single registration for the edit form.
     */
    public function edit(Daftar $daftar): JsonResponse
    {
        return response()->json($daftar);
    }

    /**
     * Update the specified registration.
     * The old file is replaced only when a new one is uploaded.
     */
    public function update(DaftarRequest $request, Daftar $daftar): JsonResponse
    {
        $data = $request->safe()->except('berkas');

        if ($request->hasFile('berkas')) {
            $this->deleteFile($daftar);
            $data += $this->storeFile($request);
        }

        $daftar->update($data);

        return response()->json(['success' => 'Data berhasil diperbarui.']);
    }

    /**
     * Remove the specified registration and its uploaded file.
     */
    public function destroy(Daftar $daftar): JsonResponse
    {
        $this->deleteFile($daftar);
        $daftar->delete();

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }

    /**
     * Simpan berkas yang diunggah, kembalikan kolom `berkas` dan `nama_berkas`.
     *
     * @return array<string, string>
     */
    private function storeFile(DaftarRequest $request): array
    {
        $file = $request->file('berkas');

        return [
            'berkas' => $file->store(self::FOLDER, self::DISK),
            'nama_berkas' => $file->getClientOriginalName(),
        ];
    }

    /**
     * Hapus berkas milik pendaftar dari storage (jika ada).
     */
    private function deleteFile(Daftar $daftar): void
    {
        if ($daftar->berkas) {
            Storage::disk(self::DISK)->delete($daftar->berkas);
        }
    }
}
