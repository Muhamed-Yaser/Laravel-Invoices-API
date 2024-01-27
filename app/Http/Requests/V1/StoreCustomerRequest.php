<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user(); //only users with tokens can store
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required'],
            'type'=>['required' , Rule::in(['I' , 'B' , 'i' , 'b'])],
            'email' =>['required' , 'email'],
            'address'=>['required'],
            'city' =>['required'],
            'state' =>['required'],
            'postal_code'=>['required']
        ];
    }
    protected function prepareForValidation()
    {
        if($this->postalCode){
            $this->merge([
                'postal_code'=>$this->postalCode
            ]);
        }

    }
}
