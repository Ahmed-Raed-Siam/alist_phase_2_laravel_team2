<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryManagementRequest extends FormRequest
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
            'address'       => 'required|string|min:3',
            'mobile'        => 'required|numeric|digits:10',
            'evaluation'    => 'nullable|numeric|min:1|max:5',
            'total_amount'  => 'required|numeric',
            'status'        => 'required|integer',
            'order_id'      => 'required|integer|exists:orders_products,id',
            'driver_id'     => 'required|integer|exists:delivery_drivers,id',
        ];
    }
}
