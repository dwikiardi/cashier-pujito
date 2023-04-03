<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class PasswordRequest extends FormRequest
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
            // 'current_password' => ['required'],
            'new_password' => ['required', 'same:verify_password', 'min:8', 'max:12'],
            'verify_password' => ['required', 'same:new_password'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'same' => ':attribute tidak cocok',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
            'min' => ':attribute tidak boleh kurang dari :min karakter',
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => 'Password sekarang',
            'new_password' => 'Password baru',
            'verify_password' => 'Password konfirmasi',
        ];
    }

    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if($this->current_password == null){
                $validator->errors()->add('current_password', 'Password sebelumnya tidak boleh kosong');
            } else {
                if (!Hash::check($this->current_password, $this->user()->password)) {
                    $validator->errors()->add('current_password', 'Password sebelumnya tidak cocok.');
                }
            }
        });
        return;
    }
}
