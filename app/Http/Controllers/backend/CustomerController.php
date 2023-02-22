<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Customer List';
        $data['customer'] = Customer::get();

        return view('backend.master-data.customer.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Customer Create';
        $data['customer'] = Customer::get();

        return view('backend.master-data.customer.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'name' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
            'name_ppic' => 'required',
            'email' => 'required',
            'term_of_payment' => 'required',
           
        ]);
        $customer = new Customer();
        $customer->customer = $request->customer;
        $customer->name = $request->name;
        $customer->kota = $request->kota;
        $customer->alamat = $request->alamat;
        $customer->kode_pos = $request->kode_pos;
        $customer->no_tlp = $request->no_tlp;
        $customer->name_ppic = $request->name_ppic;
        $customer->email = $request->email;
        $customer->term_of_payment = $request->term_of_payment;
        
        $customer->save();

        return redirect()->route('backend.customer.index')->with('success','Customer created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Customer';
        $data['customer'] = Customer::findOrfail($id);

        return view('backend.master-data.customer.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'customer' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
            'name_ppic' => 'required',
            'email' => 'required',
            'term_of_payment' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->customer = $request->customer;
        $customer->name = $request->name;
        $customer->kota = $request->kota;
        $customer->alamat = $request->alamat;
        $customer->kode_pos = $request->kode_pos;
        $customer->no_tlp = $request->no_tlp;
        $customer->name_ppic = $request->name_ppic;
        $customer->email = $request->email;
        $customer->term_of_payment = $request->term_of_payment;
        $customer->save();

        return redirect()->route('backend.customer.index')->with(['success' => 'Customer edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $customer = Customer::findOrFail($id);
            $customer->delete();
        });
        
        Session::flash('success', 'Customer deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
