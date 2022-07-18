<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AltterNativeRequest extends FormRequest
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
            'trade_name'=> 'required|string|max:100|unique:allter_natives,trade_name'.$this -> id,
            'scientific_name'=>'required|string|max:100|unique:allter_natives,scientific_name'.$this->id,
            'medication_id'=>'required',
            'made_in'=>['required','string','regex:/^[a-zA-Z]+$/u'],
            'quntity'=>'required|Integer|min:1',
            'price'=>'required|Integer|regex:/^\d+(\.\d{1,2})?$/',
            'production_date' => 'required',
            'expiry_date'=>'required|date|after:production_date',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'min'=>'يجب ان يكون اقل كمية مدخلة =1',
            'unique'=>'موجود من قبل',
            'regex'=>' يجب ان يكون ارقام',
            'made_in.regex'=>'يجب ان يكون حروف',
            'trade_name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'scientific_name.string' =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'photo.required_without'  => 'الصوره مطلوبة',
            'after'=>'تاريخ الانتهاءيجب ان يكون بعد تاريخ الانتاج'
           
        ];
    }
}
