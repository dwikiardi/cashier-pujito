<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandwidthRequest extends FormRequest
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
            'ip_radio' => ['required'],
            'ip_access' => ['required'],
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes()
    {
        return [
            'ip_access' => 'IP Access',
            'ip_radio' => 'IP Radio',
        ];
    }
}