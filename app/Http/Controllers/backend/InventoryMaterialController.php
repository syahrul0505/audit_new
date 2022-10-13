<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryMaterial;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InventoryMaterialController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Inventory Material List';
        $data['inventory_material'] = InventoryMaterial::get();
        
        return view('backend.inventory.material.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Inventory Material List';
        $data['Inventory_material'] = InventoryMaterial::get();
        $data['material'] = Material::get();
        
        // dd($data['product']);
        return view('backend.inventory.material.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required',
            'begin_stock' => 'nullable',
           
        ]);
        $inventory_material = new InventoryMaterial();
        $inventory_material->date = $request->date;
        $inventory_material->material_id = $request->material_id;
        $inventory_material->begin_stock = $request->begin_stock;
        $inventory_material->total_stock = $request->total_stock;
        $inventory_material->description = $request->description;
        
        $inventory_material->save();

        return redirect()->route('backend.inventory_material.index')->with('success','Inventory Material created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Inventory Material';
        $data['inventory_Material'] = InventoryMaterial::findOrfail($id);
        $data['material'] = Material::get();

        return view('backend.inventory.material.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        $inventory_material = InventoryMaterial::findOrFail($id);
        $inventory_material->date = $request->date;
        $inventory_material->material_id = $request->material_id;
        $inventory_material->begin_stock = $request->begin_stock;
        $inventory_material->total_stock = $request->total_stock;
        $inventory_material->description = $request->description;
        
        $inventory_material->save();

        return redirect()->route('backend.material.index')->with(['success' => 'Inventory Material edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $inventory_material = InventoryMaterial::findOrFail($id);
            $inventory_material->delete();
        });
        
        Session::flash('success', 'Material deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
