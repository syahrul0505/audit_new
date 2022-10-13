<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryMaterial;
use App\Models\StockOutMaterial;
use App\Models\Employee;
use App\Models\Material;

class StockOutMaterialController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Stock Out List';
        $data['stock_out'] = StockOutMaterial::get();
        
        return view('backend.inventory.material.stock-out.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Stock Out List';
        $data['stock_out'] = StockOutMaterial::get();
        $data['inventory_material'] = InventoryMaterial::get();
        $data['employee'] = Employee::get();
        $data['material'] = Material::get();
        
        // dd($data['product']);
        return view('backend.inventory.material.stock-out.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_material = new StockOutMaterial();
        $inventory_material->material_id = $request->material_id;
        $inventory_material->material_outgoing = $request->material_outgoing;
        $inventory_material->employee_id = $request->employee_id;
        $inventory_material->current_stock = $request->current_stock;
        $inventory_material->description = $request->description;
        
        $inventory_material->save();

        return redirect()->route('backend.stock_out_material.index')->with('success','Stock Out Material created successfully');
    }
}
