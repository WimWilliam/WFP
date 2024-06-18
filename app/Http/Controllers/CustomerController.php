<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           //Menggunakan model
           $rsCustomer = Customer::all();

           return view('customer.index', compact('rsCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.formcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Customer();
        $data->name = $request->customer_name;
        $data->address = $request->customer_address;
        $data->save();
        return redirect()->route("customer.index")->with("status", "Data baru berhasil tersimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $data = $customer;
        return view("customer.formedit", compact('data'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $updatedData = $customer;
        $updatedData->address = $request->customer_address;
        $updatedData->save();
        return redirect()->route('customer.index')->with('status','Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $deletedData = $customer;
        try {
                    //if no contraint error, then delete data. Redirect to index after it.
                    $deletedData = $customer;
                    $deletedData->delete();
                    return redirect()->route('customer.index')->with('status','Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {
                    // Failed to delete data, then show exception message
                    $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
                    return redirect()->route('customer.index')->with('statusError',$msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Customer::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('customer.getEditForm', compact('data'))->render()
        ),200);
    }

}
