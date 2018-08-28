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
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_ketua' => 'required:teams',
            'nim_ketua' => 'required:teams',
            'fkja_ketua' => 'required:teams',
            'no_hp_ketua' => 'required:teams',
            'foto_ktm_ketua' => 'required|image|max:1024',
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
            'kategori_id.required' => 'Kategori Tim masih kosong',  
            'nama_ketua.required' => 'Nama Ketua Tim masih kosong',
            'nim_ketua.required' => 'Nim Ketua Tim masih kosong',
            'fkja_ketua.required' => 'Fakultas Ketua Tim masih kosong',
            'no_hp_ketua.required' => 'No HP masih kosong',
            'foto_ktm_ketua.required' => 'File KTM Ketua masih kosong',
            'foto_ktm_ketua.mimes' => 'Format File KTM harus PDF',
            'foto_ktm_ketua.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota1.mimes' => 'Format File KTM harus PDF',
            'foto_ktm_anggota1.max' => 'Size proposal terlalu besar',
            'foto_ktm_anggota2.mimes' => 'Format File KTM harus PDF',
            'foto_ktm_anggota2.max' => 'Size proposal terlalu besar',
        ];
    }
}
