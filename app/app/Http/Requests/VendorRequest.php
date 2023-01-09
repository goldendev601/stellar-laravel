<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class VendorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asset_category_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'max:150'
            ],
            'alias' => [
                'required',
                'unique:vendor,alias,'. $this->vendor_id,
                'max:150'],
            'address' => [
                'required',
                'unique:vendor,address,'. $this->vendor_id,
                'nullable'],
            'timezone' => [
                'required',
                'max:150'
            ],
            'email' => [
                'nullable',
                'email',
                'max:255'
            ],
            'photos.*' => [
                'nullable',
                'mimes:jpg,jpeg,png,bmp',
                'max:2048'
            ]
        ];
    }

    /**
     * Change the attribute name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'asset_category_id' => 'Category',
            'name' => 'Supplier name',
            'email' => 'Email',
            'alias' => 'Alias'
        ];
    }
}
