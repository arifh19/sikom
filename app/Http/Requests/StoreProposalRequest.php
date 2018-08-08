<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Alert;

class StoreProposalRequest extends FormRequest
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
            'judul' => 'required:proposals,judul',
            'kategori_id' => 'required|exists:kategoris,id',
            //'upload' => 'image|max:1024'
            'upload' => 'required|mimes:pdf|max:10240'
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
            'judul.required' => 'Judul proposal masih kosong',
            'kategori_id.required' => 'Kategori Lomba masih kosong',
            'kategori_id.exists' => 'Kategori Lomba tidak ada',
            'upload.mimes' => 'proposal harus format pdf',
            'upload.max' => 'Size proposal terlalu besar'
        ];
        

    }
}
