<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranch extends FormRequest
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
            'name' => 'required | unique:branches',
            'email' => 'required | unique:branches',
            'contact' => 'required | unique:branches',
            'dealerCode' => 'required',
            'keyPerson1Contact' => 'required | unique:branches,key_person1_contact',
            'keyPerson2Contact' => 'required | unique:branches,key_person2_contact',
            'address' => 'required',
        ];
    }
}
