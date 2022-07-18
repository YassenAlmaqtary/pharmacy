<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AltterNativeRequestExsists extends FormRequest
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
                'price'=>'required|Integer|regex:/^\d+(\.\d{1,2})?$/',
                'production_date' => 'required',
                'expiry_date'=>'required|date|after:production_date',
                'allter_native_id'=>'required',

               
        ];
    }

    public function messages(){
        return [
            'required'  => 'هذا الحقل مطلوب ',
            'min'=>'يجب ان يكون اقل كمية مدخلة =1',
            'regex'=>' يجب ان يكون ارقام',
            'after'=>'تاريخ الانتهاءيجب ان يكون بعد تاريخ الانتاج'
           
        ];
    }  

}
