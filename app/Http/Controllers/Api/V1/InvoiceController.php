<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoiceFilter;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $filter = new InvoiceFilter();
        $queryItems = $filter->transfrom($request); //[['column' , operator' , value']]

        if(count($queryItems) == 0){

            return new InvoiceCollection(Invoice::all());

        }else
        {
            return new InvoiceCollection(Invoice::where($queryItems)->get());
        }

    }


    public function create()
    {
        //
    }


    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr , $key){
            return Arr::except($arr , ['customerId' , 'billedDate' ,'paidDate' ]);
        });

        Invoice::insert($bulk->toArray());
    }


    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }


    public function edit(Invoice $invoice)
    {
        //
    }


    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }


    public function destroy(Invoice $invoice)
    {
        //
    }
}
