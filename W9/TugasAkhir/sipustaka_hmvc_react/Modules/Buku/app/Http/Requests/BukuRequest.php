<?php

namespace Modules\Buku\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya admin yang boleh menambah dan mengubah buku
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:'.date('Y')],
            'stok' => ['required', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'Judul',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 'Tahun terbit',
            'stok' => 'Stok',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka bulat.',
            'judul.max' => 'Judul maksimal :max karakter.',
            'penulis.max' => 'Penulis maksimal :max karakter.',
            'penerbit.max' => 'Penerbit maksimal :max karakter.',
            'tahun_terbit.min' => 'Tahun terbit minimal :min.',
            'tahun_terbit.max' => 'Tahun terbit maksimal :max.',
            'stok.min' => 'Stok tidak boleh kurang dari :min.',
            'stok.max' => 'Stok maksimal :max.',
        ];
    }
}