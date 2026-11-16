<?php

namespace Modules\TitikDrainase\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class titikRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    
    public function rules(): array
    {
        return [
            'nama_titik' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'tetx', 'max:500'],
            'kedalaman' => ['required', 'integer', 'min:0', 'max:255']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
          return (bool) $this->user()?->isAdmin();
    }

     public function attributes(): array
    {
        return [
            'nama_titik' => 'Nama Titik',
            'kecamatan' => 'Kecamatan',
            'deskripsi' => 'Deskripsi',
            'Kedalaman' => 'Kedalaman',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka bulat.',
        ];
    }
}
