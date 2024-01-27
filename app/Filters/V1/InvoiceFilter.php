<?php
namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter {

    protected $safeParms = [
            'customerId' =>['eq'],
            'amount' =>['eq' , 'gt' ,'gte','lte', 'lt'],
            'status' =>['eq', 'not'],
            'billedDate'=> ['eq' , 'gt' ,'gte','lte', 'lt'],
            'paidDate' =>  ['eq' , 'gt' ,'gte','lte', 'lt'],
    ];

    protected $columnMap = [
            'customerId' => 'customer_id',
            'billedDate' => 'billed_date',
            'paidDate' => 'paid_date'    //this line to match the column name in database
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'not' => '!='
    ];
}
