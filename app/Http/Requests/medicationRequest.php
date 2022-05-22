<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
            'photo'=> 'required_without:id|mimes:jpg,jpeg,png,svg',
            'trade_name'=> 'required|string|max:100|unique:medications,trade_name'.$this -> id,
            'scientific_name'=>'required|string|max:100|unique:medications,scientific_name'.$this->id,
            'mypharmacy_id'=>'required',
            'made_in'=>'required|string',
            'quntity'=>'required|Integer|min:1',
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'production_date' => 'required',
            'expiry_date'=>'required',
           
        ];
    }


    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'min'=>'يجب ان يكون اقل كمية مدخلة =1',
            'unique'=>'موجود من قبل',
            'regex'=>' يجب ان يكون ارقام',
            'trade_name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'scientific_name.string' =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'photo.required_without'  => 'الصوره مطلوبة',
           
        ];
    }

}
