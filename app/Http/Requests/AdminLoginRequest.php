<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            //
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages()
    {

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'email.email' => 'ضيغه البريد الالكتروني غير صحيحه',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل ',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
            'password.required' => 'كلمة المرور مطلوبة.'
        ];
    }
}
