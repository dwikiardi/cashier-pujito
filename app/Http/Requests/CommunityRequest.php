<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommunityRequest extends FormRequest
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
            'gender' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'same:password_confirmation', 'min:8', 'max:12'],
            'password_confirmation' => ['required', 'same:password'],
            'image' => ['required', 'mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
        ];
        
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya mengandung huruf',
            'numeric' => ':attribute hanya mengandung angka',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'min' => ':attribute tidak boleh kurang dari :min karakter',
            'mimes' => 'Format :attribute hanya mendukung :mimes',
            'size' => 'Ukuran file :attribute maksimal :size',
            'email' => 'Format :attribute salah',
            'same' => ':attribute tidak sama',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'gender' => 'Jenis kelamin',
            'phone' => 'No. HP',
            'address' => 'Alamat',
            'image' => 'Foto profil',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi password'
        ];
    }
}
