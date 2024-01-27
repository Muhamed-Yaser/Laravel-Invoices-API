<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreInvoiceRequest extends FormRequest
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
            '*.customerId'=>['required' , 'integer'],
            '*.amount'=>['required' , 'numeric'],
            '*.status' =>['required' , Rule::in(['P' , 'B' ,'V', 'p' , 'b' ,'v'])],
            '*.billedDate'=>['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' =>['nullable' , 'date_format:Y-m-d H:i:s'],
        ];
    }
    protected function prepareForValidation()
    {
        $data = [];

        foreach($this->toArray() as $obj){
           $obj['customer_id'] = $obj['customerId'] ?? null ;
           $obj['billed_date'] = $obj['billedDate'] ?? null ;
           $obj['paid_date'] = $obj['paidDate'] ?? null ;

           $data[] = $obj;
        }
            $this->merge($data);
    }
}
