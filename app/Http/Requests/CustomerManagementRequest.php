<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerManagementRequest extends FormRequest
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
            'customer_image'=>'image|mimes:png,jpg,jpeg|required_if:type,==,create',
            'shop_owner_name'=>'required',
            'supermarket_name'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'total_point'=>'required',
        ];
    }
}
