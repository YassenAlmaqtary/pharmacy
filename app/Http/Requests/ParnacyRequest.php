<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParnacyRequest extends FormRequest
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
                'name'=> 'required|string|max:100',
                'mobile1'=>'required|max:9|unique:mypharmacys,mobile1,'.$this -> id,
                'mobile2'=>'max:9|unique:mypharmacys,mobile2,'.$this -> id,
                'address' => 'required|string|max:500',
                'pdf'=>'required_without:id|mimes:pdf,xlx,csv|max:2048',
        ];
               
    }


    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'logo.required_without'  => 'الصوره مطلوبة',
            'mobile1.unique' => 'رقم الهاتف مستخدم من قبل ',
            'mobile2.unique' => 'رقم الهاتف مستخدم من قبل ',

        ];
    }

}
