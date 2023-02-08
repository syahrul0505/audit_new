<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Employee;
use App\Models\StockInMaterial;
use App\Models\InventoryMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StockInMaterialController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Stock In List';
        $data['stock_in'] = StockInMaterial::get();
        
        return view('backend.inventory.material.stock-in.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Stock In List';
        $data['stock_in'] = StockInMaterial::get();
        $data['inventory_material'] = InventoryMaterial::get();
        $data['employee'] = Employee::get();
        $data['material'] = Material::get();
        
        // dd($data['product']);
        return view('backend.inventory.material.stock-in.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'nullable',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_material = new StockInMaterial();
        $inventory_material->material_id = $request->material_id;
        $inventory_material->material_incoming = $request->material_incoming;
        $inventory_material->date = $request->date;
        $inventory_material->employee_id = $request->employee_id;
        $inventory_material->current_stock = $request->current_stock;
        $inventory_material->description = $request->description;
        
        $inventory_material->save();

        return redirect()->route('backend.inventory_material.index')->with('success','Stock In created successfully');
    }

    public function getStockById(Request $request)
    {
        $material_id = $request->material_id;
        $material = Inventorymaterial::where('material_id',$material_id)->first();
        $total_stock = $material->stok_tersedia($material->material->id);

        $data = [
            'total_stock' => $total_stock
        ];
        return response($data);

    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $stock_in_naterial = StockInMaterial::findOrFail($id);
            $stock_in_naterial->delete();
        });
        
        Session::flash('success', 'Stock Out Material deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
