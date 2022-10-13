<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Product List';
        $data['product'] = Product::get();

        return view('backend.master-data.product.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Product List';
        $data['product'] = Product::get();

        return view('backend.master-data.product.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
           
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->gramasi = $request->gramasi;
        $product->thickness = $request->thickness;
        $product->lebar = $request->lebar;
        $product->panjang = $request->panjang;
        $product->description = $request->description;
        
        $product->save();

        return redirect()->route('backend.product.index')->with('success','Product created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Forecast';
        $data['product'] = Product::findOrfail($id);

        return view('backend.master-data.product.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->gramasi = $request->gramasi;
        $product->thickness = $request->thickness;
        $product->lebar = $request->lebar;
        $product->panjang = $request->panjang;
        $product->description = $request->description;
        
        $product->save();

        return redirect()->route('backend.product.index')->with(['success' => 'Product edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $product = Product::findOrFail($id);
            $product->delete();
        });
        
        Session::flash('success', 'Product deleted successfully!');
        return response()->json(['status' => '200']);
    }

}
