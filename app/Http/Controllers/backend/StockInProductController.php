<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockInProduct;
use App\Models\InventoryProduct;
use App\Models\Employee;


class StockInProductController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Stock In List';
        $data['stock_in'] = StockInProduct::get();
        
        return view('backend.inventory.product.stock-in.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Stock In List';
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

        return redirect()->route('backend.inventory_product.index')->with('success','Stock In created successfully');
    }
}
