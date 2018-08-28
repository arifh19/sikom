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
            'judul' => 'required:proposals',
            'kategori_id' => 'required:proposals',
            'upload' => 'required:mimes:pdf',
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
            'judul.required' => 'Judul masih kosong',
            'kategori_id.required' => 'Kategori masih kosong',
            'upload.required' => 'File masih kosong',
            'upload.mimes' => 'Format file harus PDF',
        ];
        

    }
}
