<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePointsTransferRequest extends FormRequest
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
            'from'         => 'required|integer|exists:customer_managments,id',
            'to'           => 'required|numeric:digits:10|exists:customer_managments,mobile',
            'points_number'=> 'required|integer|min:1',
        ];
    }
}
