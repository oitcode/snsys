<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRemit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
	/* Todo: Actually authorize. */
        return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    /* Currency */
	    'currency' => 'required',

	    /* Bank voucher */
	    'bv-num' => 'required',
	    'bv-deposit-date' => 'required',
            'bv-depositor' => 'required',
            'bv-amount' => 'required',

	    /* Main info */
            'family-code' => 'required',
            'submitter-name' => 'required',
            'submitter-address' => 'required',
            'submitted-date' => 'required',
            'submitted-total' => 'required',
            'delivered-by' => 'required',
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
	    /* No after hooks for this request, as of now. */
	    /*
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
	    */
        });
    }
}
