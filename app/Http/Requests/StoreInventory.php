<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventory extends FormRequest
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
            'product' => 'required',
            'version' => 'required',
            'type' => 'required',
            "colors"    => 'required|array',
            "colors.*"  => 'required|string',
            "engineNos"    => 'required|array',
            "engineNos.*"  => 'required|string|distinct|unique:inventories,engine_no',
            "chasisNos"    => 'required|array',
            "chasisNos.*"  => 'required|string|distinct|unique:inventories,chassis_no',


        ];
    }
}
