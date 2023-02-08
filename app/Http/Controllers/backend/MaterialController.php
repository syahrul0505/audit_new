<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MaterialController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Material List';
        $data['material'] = Material::get();

        return view('backend.master-data.material.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Material List';
        $data['material'] = Material::get();

        return view('backend.master-data.material.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
           
        ]);
        $material = new Material();
        $material->name = $request->name;
        $material->code = $request->code;
        $material->gramasi = $request->gramasi;
        $material->thickness = $request->thickness;
        $material->lebar = $request->lebar;
        $material->panjang = $request->panjang;
        
        $material->save();

        return redirect()->route('backend.material.index')->with('success','Material created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Material';
        $data['material'] = Material::findOrfail($id);

        return view('backend.master-data.material.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'code'   => 'required',
            'name' => 'required',
        ]);

        $material = Material::findOrFail($id);
        $material->name = $request->name;
        $material->code = $request->code;
        $material->thickness = $request->thickness;
        $material->lebar = $request->lebar;
        $material->panjang = $request->panjang;
        
        $material->save();

        return redirect()->route('backend.material.index')->with(['success' => 'Material edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $material = Material::findOrFail($id);
            $material->delete();
        });
        
        Session::flash('success', 'Material deleted successfully!');
        return response()->json(['status' => '200']);
    }


}
