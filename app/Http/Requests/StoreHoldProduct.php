<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHoldProduct extends FormRequest
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
        return [
            'customerName' => 'required|regex:/^[\pL\s\-]+$/u',
            'customerPhoneNo' => 'required|numeric',
            'productName' => 'required|numeric',
            'version' => 'required|numeric',
            'color' => 'required',
            'inventoryItem' => 'required|numeric',
            'tokenAmount' => 'required|numeric',
            'description' => 'required',

        ];
    }
}
