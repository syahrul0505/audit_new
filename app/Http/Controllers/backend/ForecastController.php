<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forecast;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ForecastController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Forecast List';
        $data['forecast'] = Forecast::get();
        
        return view('backend.forecast.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Forecast List';
        $data['forecast'] = Forecast::get();
        $data['employee'] = Employee::get();
        $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.forecast.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'employee_id' => 'nullable',
            'date' => 'nullable',
           
        ]);
        $forecast = new Forecast();
        $forecast->product_id = $request->product_id;
        $forecast->employee_id = $request->employee_id;
        $forecast->date = $request->date;
        $forecast->qty = $request->qty;
        $forecast->description = $request->description;
        
        $forecast->save();

        return redirect()->route('backend.forecast.index')->with('success','Forecast created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Forecast';
        $data['forecast'] = Forecast::findOrfail($id);
        $data['employee'] = employee::get();

        return view('backend.forecast.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        $forecast = Forecast::findOrFail($id);
        $forecast->product_id = $request->product_id;
        $forecast->employee_id = $request->employee_id;
        $forecast->date = $request->date;
        $forecast->qty = $request->qty;
        $forecast->description = $request->description;
        
        $forecast->save();

        return redirect()->route('backend.forecast.index')->with(['success' => 'Forecast edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $forecast = Forecast::findOrFail($id);
            $forecast->delete();
        });
        
        Session::flash('success', 'Forecast deleted successfully!');
        return response()->json(['status' => '200']);
    }

    public function getGramasiById(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        $gramasi = $product->gramasi;
        return $gramasi;
    }
}
