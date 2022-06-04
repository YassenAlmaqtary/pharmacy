<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequsetExsits extends FormRequest
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
          
    

                'quntity'=>'required|Integer|min:1',
                'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'production_date' => 'required',
                'expiry_date'=>'required',
                'medication_id'=>'required',
                'mypharmacy_id'=>'required',
                
               
            ];
        
    }
}
