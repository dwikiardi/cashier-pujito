<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SaleRequest extends FormRequest
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
        if(!Request::instance('sale_id')) {
            $total = ['required', 'numeric'];
        }else {
            $total = ['numeric'];
        }
        return [
            'sale_date' => ['required','date'],
            'discount' => ['required', 'numeric'],
            'total' => $total,
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'date' => 'Format :attribute salah',
            'numeric' => ':attribute hanya mengandung angka'
        ];
    }

    public function attributes()
    {
        return [
            'sale_date' => 'tanggal tiket terjual',
            'discount' => 'Diskon',
            'total' => 'Total tiket'
        ];
    }
}
