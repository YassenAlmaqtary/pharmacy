<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png,svg',
            'name'=>'required|string|max:100',
            'description'=> 'string|required',
        ];
    }


    public function messages()
    {
        return [
            'required'=>'هذا الحقل مطلوب',
            'string'=>'الاسم يجب ان يكون احرف',
            'required_without'=>'يجب ادخال الصورة',
            'max'=>'يجب ان يكون  الحوف اقل من 100'
        ];
    }
}
