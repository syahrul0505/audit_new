<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorPivot;

class ListFinanceController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'List Finance';
        $data['vendor'] = Vendor::get();

        return view('backend.list-finance.index', $data); 
    }

    public function edit($id)
    {
        $data['page_title'] = 'Finance Create';
        $data['vendor'] = Vendor::findOrfail($id);

        return view('backend.list-finance.index', $data);
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

    public function show(){

    }
}
