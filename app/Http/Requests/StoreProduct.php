<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
      $rules =array();
      //Getting the count of models
      $modelsArr = $this->request->get('model');
      $modelCount = count($modelsArr);

      //Getting a count of versoins
      $versionsArr = $this->request->get('version');
      $versionCount = count($versionsArr);

      $rules['model'] = "required|min:$versionCount|max:$versionCount";
      $rules['version'] = "required|min:$modelCount|max:$modelCount";
      $rules['name'] = 'required';
      $rules['company'] = 'required';
      $rules['branchId'] = 'required';
      $rules['description'] = 'required';
      $rules['image'] = 'required';
      return $rules;
    }
}
