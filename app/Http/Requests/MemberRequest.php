<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MemberRequest extends FormRequest
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
            'place_of_birth' => ['required'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
        ];

        // for store/create data
        if(!Request::instance()->member_id){
            $rules += [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'max:12'],
                'password_confirmation' => ['required', 'same:password'],
                'image' => ['required', 'mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
            ];
        } else {
            $rules += [
                'image' => ['mimes:png,jpg,jpeg,bmp', 'max:4096', 'image', 'file']
            ];
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya mengandung huruf',
            'date' => 'Format :attribute salah',
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
            'place_of_birth' => 'Tempat lahir',
            'date_of_birth' => 'Tanggal lahir',
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
