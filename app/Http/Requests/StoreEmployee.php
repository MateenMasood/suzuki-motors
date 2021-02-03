<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email| unique:users',
            'phoneNo' => 'required | unique:users,contact',
            'password' => 'required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'required',
            'cnic' => 'required| unique:employees,cnic',
            'dob' => 'required',
            'role' => 'required|numeric',
            'branch' => 'required|numeric',
            'department' => 'required',
            'address' => 'required',
        ];
    }
}
