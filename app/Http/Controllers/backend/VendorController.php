<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Vendor List';
        $data['vendor'] = Vendor::get();

        return view('backend.vendor.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Vendor Create';
        $data['vendor'] = Vendor::get();

        return view('backend.vendor.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_po' => 'required',
           
        ]);
        $vendor = new Vendor();
        $vendor->tanggal_po = $request->tanggal_po;
        $vendor->no_po = $request->no_po;
        $vendor->no_inv_vendor = $request->no_inv_vendor;
        $vendor->tanggal_kirim = $request->tanggal_kirim;
        $vendor->email = $request->email_vendor;
        
        $vendor->save();

        return redirect()->route('backend.vendor.index')->with('success','Vendor created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Vendor';
        $data['breadcumb'] = 'Edit Vendor';
        $data['vendor'] = Vendor::findOrFail($id);

        return view('backend.vendor.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nik'   => 'nullable',
            'description' => 'nullable',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->tanggal_po = $request->tanggal_po;
        $vendor->no_po = $request->no_po;
        $vendor->no_inv_vendor = $request->no_inv_vendor;
        $vendor->tanggal_kirim = $request->tanggal_kirim;
        $vendor->email = $request->email_vendor;
        
        $vendor->save();

        return redirect()->route('backend.vendor.index')->with(['success' => 'vendor edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $employee = Vendor::findOrFail($id);
            $employee->delete();
        });
        
        Session::flash('success', 'Employee deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
