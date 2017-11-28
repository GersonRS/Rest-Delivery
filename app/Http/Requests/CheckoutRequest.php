<?php

namespace Delivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'company'=> 'exists:companies,id',
            'cupom'=> 'nullable|exists:cupoms,code,used,0',
            'items'=> 'required'
        ];
    }
}
