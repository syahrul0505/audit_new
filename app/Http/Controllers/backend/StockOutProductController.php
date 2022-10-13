<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryProduct;
use App\Models\StockOutProduct;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class StockOutProductController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Stock Out List';
        $data['stock_out'] = StockOutProduct::get();
        
        return view('backend.inventory.product.stock-out.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Stock Out List';
        $data['stock_out'] = StockOutProduct::get();
        $data['inventory_product'] = InventoryProduct::get();
        $data['employee'] = Employee::get();
        $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.inventory.product.stock-out.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_product = new StockOutProduct();
        $inventory_product->product_id = $request->product_id;
        $inventory_product->product_outgoing = $request->product_outgoing;
        $inventory_product->employee_id = $request->employee_id;
        $inventory_product->current_stock = $request->current_stock;
        $inventory_product->description = $request->description;
        
        $inventory_product->save();

        return redirect()->route('backend.stock_out_product.index')->with('success','Stock Out created successfully');
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
    
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $stock_out = StockOutProduct::findOrFail($id);
            $stock_out->delete();
        });
        
        Session::flash('success', 'Stock Out deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
