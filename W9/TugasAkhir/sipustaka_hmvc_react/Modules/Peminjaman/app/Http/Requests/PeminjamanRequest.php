<?php

namespace Modules\Peminjaman\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Peminjaman\Models\Peminjaman;

class PeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hak akses (admin dan user) sudah dijaga oleh middleware role di route
        return true;
    }

    public function rules(): array
    {
        // Saat edit, route membawa model Peminjaman sehingga file bukti boleh dikosongkan
        $peminjaman = $this->route('peminjaman');

        return [
            'nama_peminjam' => ['required', 'string', 'max:255'],
            'judul_buku' => ['required', 'string', 'max:255'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_kembali' => ['required', 'date', 'after_or_equal:tanggal_pinjam'],
            'status' => ['required', Rule::in(Peminjaman::STATUS)],
            'bukti' => [
                $peminjaman ? 'nullable' : 'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_peminjam' => 'Nama peminjam',
            'judul_buku' => 'Judul buku',
            'tanggal_pinjam' => 'Tanggal pinjam',
            'tanggal_kembali' => 'Tanggal kembali',
            'status' => 'Status',
            'bukti' => 'Bukti peminjaman',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'nama_peminjam.max' => 'Nama peminjam maksimal :max karakter.',
            'judul_buku.max' => 'Judul buku maksimal :max karakter.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
            'status.in' => 'Status harus Dipinjam atau Dikembalikan.',
            'bukti.file' => 'Bukti peminjaman harus berupa file.',
            'bukti.uploaded' => 'Bukti peminjaman gagal diunggah.',
            'bukti.mimes' => 'Bukti peminjaman harus berformat jpg, jpeg, png, atau pdf.',
            'bukti.max' => 'Ukuran bukti peminjaman maksimal 2 MB.',
        ];
    }
}