<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryProduct;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InventoryProductController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Inventory Product List';
        $data['inventory_product'] = InventoryProduct::get();
        
        return view('backend.inventory.product.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Inventory Product List';
        $data['Inventory_product'] = InventoryProduct::get();
        $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.inventory.product.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_product = new InventoryProduct();
        $inventory_product->date = $request->date;
        $inventory_product->product_id = $request->product_id;
        $inventory_product->begin_stock = $request->begin_stock;
        $inventory_product->total_stock = $request->total_stock;
        $inventory_product->description = $request->description;
        
        $inventory_product->save();

        return redirect()->route('backend.inventory_product.index')->with('success','Inventory Product created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Inventory Product';
        $data['inventory_product'] = InventoryProduct::findOrfail($id);
        $data['product'] = Product::get();

        return view('backend.inventory.product.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        $inventory_product = InventoryProduct::findOrFail($id);
        $inventory_product->date = $request->date;
        $inventory_product->product_id = $request->product_id;
        $inventory_product->begin_stock = $request->begin_stock;
        $inventory_product->total_stock = $request->total_stock;
        $inventory_product->description = $request->description;
        
        $inventory_product->save();

        return redirect()->route('backend.employee.index')->with(['success' => 'Inventory Product edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $inventory_product = InventoryProduct::findOrFail($id);
            $inventory_product->delete();
        });
        
        Session::flash('success', 'Employee deleted successfully!');
        return response()->json(['status' => '200']);
    }

}
