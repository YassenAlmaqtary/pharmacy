<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParnacyRequestExsist extends FormRequest
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
                'mobile1'=>['required','min:9','max:9','regex:/^((71)|(73)|(77)|(70))[0-9]{7}/'],
                'mobile2'=>['nullable','max:6','min:6','regex:/^((20)|(24))[0-9]{4}/'],
                'address' => 'required|string|max:500',
                'adderss_details'=> 'required|string|max:500',
                'pdf'=>'required_without:id|mimes:pdf,xlx,csv|max:2048',
                
        ];
               
    }


    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'mypharmacy_id'=>'يجب ان تسجل في الصيدلية اولا',
            'max'  => 'هذا الحقل طويل',
            'min'  => 'هذا الحقل قصير',
            'photo.required_without'=>'الصورة مطلوبة',
            'pdf.required_without'=>'الرخصة مطلوبة',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'logo.required_without'  => 'الصوره مطلوبة',
            'mobile1.regex'=>'يجب ان يبدا برقم7',
            'mobile2.regex'=>'يجب ان يبدا برقم2',
            

        ];
    }

}
