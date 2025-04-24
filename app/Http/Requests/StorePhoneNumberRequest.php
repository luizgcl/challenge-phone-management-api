<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneNumberRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => 'required|phone_number|unique:phone_numbers,value',
            'monthlyPrice' => 'required|numeric',
            'setupPrice' => 'required|numeric',
            'currency' => 'required|string',
        ];
    }
}
