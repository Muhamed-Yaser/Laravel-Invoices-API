<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Models\Customer;
use Illuminate\Http\Request;
//use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transfrom($request); //[['column' , operator' , value']]

        $inculdeInvoices = $request->query('inculdeInvoices');

        $customers = Customer::where($filterItems);


        if($inculdeInvoices){

            $customers = $customers->with('invoices');
        }
            return new CustomerCollection($customers->get());
        //spesify page ?? ==>> write ?page=12 for example in route to get page 12
        //return new CustomerCollection(Customer::paginate());
    }


    public function create()
    {
        //
    }


    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }


    public function show(Customer $customer)
    {
        $inculdeInvoices = request()->query('inculdeInvoices');

        if($inculdeInvoices){ //get invoices for only one customer with his id !!

            return new CustomerResource($customer->loadMissing('invoices'));
        }

            return new CustomerResource($customer);
    }


    public function edit(Customer $customer)
    {
        //
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }


    public function destroy(Customer $customer)
    {
        //
    }
}
