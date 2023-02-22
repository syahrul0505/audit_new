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
        $data['page_title'] = 'Add New Product';
        $data['product'] = Product::get();

        return view('backend.master-data.product.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category_product' => 'required',
            'jenis_barang' => 'required',
            'ukuran_barang' => 'required',
            'satuan_barang' => 'required',
            'qty' => 'required',
            'unit' => 'required',
           
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->category_product = $request->category_product;
        $product->merk = $request->merk;
        $product->jenis_barang = $request->jenis_barang;
        $product->ukuran_barang = $request->ukuran_barang;
        $product->satuan_barang = $request->satuan_barang;
        $product->qty = $request->qty;
        $product->unit = $request->unit;
        $product->description = $request->description;
        
        $product->save();

        return redirect()->route('backend.product.index')->with('success','Product created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Product';
        $data['product'] = Product::findOrfail($id);

        return view('backend.master-data.product.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category_product' => 'required',
            'jenis_barang' => 'required',
            'ukuran_barang' => 'required',
            'satuan_barang' => 'required',
            'qty' => 'required',
            'unit' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->category_product = $request->category_product;
        $product->merk = $request->merk;
        $product->jenis_barang = $request->jenis_barang;
        $product->ukuran_barang = $request->ukuran_barang;
        $product->satuan_barang = $request->satuan_barang;
        $product->qty = $request->qty;
        $product->unit = $request->unit;
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
        
        Session::flash('failed', 'Product deleted successfully!');
        return response()->json(['status' => '200']);
    }

}
