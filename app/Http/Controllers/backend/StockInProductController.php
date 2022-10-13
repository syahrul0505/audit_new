<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockInProduct;
use App\Models\InventoryProduct;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class StockInProductController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Stock In Product List';
        $data['stock_in'] = StockInProduct::get();
        
        return view('backend.inventory.product.stock-in.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Stock In Product List';
        $data['stock_in'] = StockInProduct::get();
        $data['inventory_product'] = InventoryProduct::get();
        $data['employee'] = Employee::get();
        $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.inventory.product.stock-in.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_product = new StockInProduct();
        $inventory_product->product_id = $request->product_id;
        $inventory_product->product_incoming = $request->product_incoming;
        $inventory_product->employee_id = $request->employee_id;
        $inventory_product->current_stock = $request->current_stock;
        $inventory_product->description = $request->description;
        
        $inventory_product->save();

        return redirect()->route('backend.stock_in_product.index')->with('success','Stock In created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Stock In Product';
        $data['stock_in'] = StockInProduct::findOrfail($id);
        $data['product'] = Product::get();
        $data['employee'] = Employee::get();

        return view('backend.inventory.product.stock-in.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        $stock_in = StockInProduct::findOrFail($id);
        $stock_in->name = $request->name;
        $stock_in->code = $request->code;
        $stock_in->gramasi = $request->gramasi;
        $stock_in->thickness = $request->thickness;
        $stock_in->lebar = $request->lebar;
        $stock_in->panjang = $request->panjang;
        $stock_in->description = $request->description;
        
        $stock_in->save();

        return redirect()->route('backend.stock_in_product.index')->with(['success' => 'Stock In Product edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $stock_in = StockInProduct::findOrFail($id);
            $stock_in->delete();
        });
        
        Session::flash('success', 'Stock In deleted successfully!');
        return response()->json(['status' => '200']);
    }

    public function getStockById(Request $request)
    {
        $product_id = $request->product_id;
        $product = InventoryProduct::where('product_id',$product_id)->first();
        $total_stock = $product->stok_tersedia($product->product->id);

        $data = [
            'total_stock' => $total_stock
        ];
        return response($data);

    }

}
