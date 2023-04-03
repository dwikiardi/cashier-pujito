<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'image' => ['mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
        ];

        // for store/create data
        // if(!Request::instance()->customer_id){
        //     $rules += [
        //         'image' => ['mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
        //     ];
        // } else {
        //     $rules += [
        //         'image' => ['mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
        //     ];
        // }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya mengandung huruf',
            'numeric' => ':attribute hanya mengandung angka',
            'mimes' => 'Format :attribute hanya mendukung :mimes',
            'size' => 'Ukuran file :attribute maksimal :size',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'phone' => 'No. HP',
            'address' => 'Alamat',
            'image' => 'Foto profil'
        ];
    }
}
