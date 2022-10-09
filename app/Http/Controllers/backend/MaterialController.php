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
        $material->dimension = $request->dimension;
        $material->description = $request->description;
        
        $material->save();

        return redirect()->route('backend.material.index')->with('success','Material created successfully');
    }

}
