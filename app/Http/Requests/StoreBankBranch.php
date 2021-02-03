<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankBranch extends FormRequest
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
            'branchName' => 'required | unique:bank_branches,name',
            'bankId' => 'required|numeric',
            'branchCode' => 'required|numeric',
            'branchPhoneNo' => 'required| unique:bank_branches,contact',
            'branchAddress' => 'required',
        ];
    }
}
