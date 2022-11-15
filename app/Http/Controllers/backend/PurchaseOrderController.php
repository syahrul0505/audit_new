<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderPivot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Purchase Order List';
        $data['purchase_order'] = PurchaseOrder::get();

        return view('backend.purchase-order.index', $data);
    }


    public function create()
    {
        $data['page_title'] = 'Purchase Order Create';
        $data['purchase_order'] = PurchaseOrder::get();

        return view('backend.purchase-order.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_no' => 'required',
            'category' => 'required',
            'nama_barang' => 'required',
            'site' => 'required',
        ]);

            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->po_no = $request->po_no;
            $purchaseOrder->category = $request->category;
            $purchaseOrder->nama_barang = $request->nama_barang;
            $purchaseOrder->site = $request->site;
            
            $purchaseOrder->save();

            // dd($purchaseOrder->id);
            $purchaseOrderPivot = [];
            foreach ($request->qty as $key => $value) {

                $vendorPivot[] = [
                    'purchase_order_id' => $purchaseOrder->id,
                    'qty' => $request->qty[$key],
                    'harga' => $request->harga[$key],
                    'total' => $request->total[$key],
                    'po_date' => $request->po_date[$key],
                    
                ];
            }
            PurchaseOrderPivot::insert($vendorPivot);
            
            return redirect()->route('backend.purchase_order.index')->with('success','Purchase Order created successfully');

    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Purchase Order';
        $data['purchase_order'] = PurchaseOrder::findOrFail($id);

        return view('backend.purchase-order.edit', $data);
    }

    public function show(){
        
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nik'   => 'nullable',
            'description' => 'nullable',
        ]);

        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->po_no = $request->po_no;
        $purchaseOrder->category = $request->category;
        $purchaseOrder->nama_barang = $request->nama_barang;
        $purchaseOrder->site = $request->site;
        $purchaseOrder->save();

        // dd($purchaseOrder->purchaseOrderProduct);
        $purchaseOrder->purchaseOrderPivot()->delete();

        $purchaseOrderPivot = [];
        foreach ($request->qty as $key => $value) {

            $purchaseOrderPivot[] = [
                'purchase_order_id' => $purchaseOrder->id,
                'qty' => $request->qty[$key],
                'harga' => $request->harga[$key],
                'total' => $request->total[$key],
                'po_date' => $request->po_date[$key],
            ];
        }
        PurchaseOrderPivot::insert($purchaseOrderPivot);
        return redirect()->route('backend.purchase_order.index')->with('success','Purchase Order Edit successfully');

    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $purchaseOrder = PurchaseOrder::findOrFail($id);
            $purchaseOrder->delete();
        });
        
        Session::flash('success', 'Purchase Order deleted successfully!');
        return response()->json(['status' => '200']);
    }

}
