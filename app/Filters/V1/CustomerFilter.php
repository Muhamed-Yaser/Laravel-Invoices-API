<?php
namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter {

    protected $safeParms = [
            'name' =>['eq'],
            'type' =>['eq'],
            'email' =>['eq'],
            'address'=> ['eq'],
            'city' => ['eq'],
            'state' => ['eq'],
            'postalCode' =>['eq' , 'gt' , 'lt']
    ];

    protected $columnMap = [
            'postalCode' => 'postal_code'    //this line to match the column name in database
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];
}
