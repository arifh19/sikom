<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_ketua' => 'required:teams',
            'nim_ketua' => 'required:teams',
            'fkja_ketua' => 'required:teams',
            'no_hp_ketua' => 'required:teams',
            'foto_ktm_ketua' => 'required:image|max:1024',
            'foto_ktm_anggota1' => 'image|max:1024',
            'foto_ktm_anggota2' => 'image|max:1024',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'nama_ketua.required' => 'Nama penulis masih kosong',
            'nim_ketua.required' => 'Penulis sudah ada',
            'fkja_ketua.required' => 'Nama penulis masih kosong',
            'no_hp_ketua.required' => 'Penulis sudah ada',
            'foto_ktm_ketua.required' => 'Cover buku harus format gambar',
            'foto_ktm_ketua.image' => 'Cover buku harus format gambar',
            'foto_ktm_anggota1.image' => 'Cover buku harus format gambar',
            'foto_ktm_anggota2.image' => 'Cover buku harus format gambar',
            'foto_ktm_ketua.max' => 'Size proposal terlalu besar'
        ];
    }
}
