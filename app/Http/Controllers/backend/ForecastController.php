<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forecast;
use App\Models\ForecastProduct;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ForecastController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Production List';
        $data['forecast'] = Forecast::get();
        
        return view('backend.forecast.index', $data);
    }
    
    public function create()
    {
        $data['page_title'] = 'Production List';
        $data['forecast'] = Forecast::get();
        $data['employee'] = Employee::get();
        $data['material'] = Material::get();
        $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.forecast.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'material_id' => 'required',
            'description' => 'required',
           
        ]);
            try {
            $forecast = new Forecast();
            $forecast->product_id = $request->product_id;
            $forecast->employee_id = $request->employee_id;
            $forecast->date = $request->date;
            $forecast->save();

            $forecastProduct = [];
            foreach ($request->material_id as $key => $value) {

                $forecastProduct[] = [
                    'forecast_id' => $forecast->id,
                    'material_id' => $request->material_id[$key],
                    'description' => $request->description[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            ForecastProduct::insert($forecastProduct);

            return redirect()->route('backend.forecast.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('backend.forecast.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Production';
        $data['forecast'] = Forecast::findOrfail($id);
        $data['employee'] = employee::get();
        $data['product'] = Product::get();
        $data['material'] = Material::get();
        
        return view('backend.forecast.edit', $data);
    }
    
    public function show($id)
    {
        $data['page_title'] = 'Show Production';
        $data['forecast'] = Forecast::findOrfail($id);
        $data['employee'] = employee::get();
        $data['product'] = Product::get();
        $data['forecast_product'] = ForecastProduct::get();

        return view('backend.forecast.show', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_id'   => 'nullable',
            'description' => 'nullable',
        ]);

        try {
            $forecast = Forecast::findOrFail($id);
            $forecast->product_id = $request->product_id;
            $forecast->employee_id = $request->employee_id;
            $forecast->date = $request->date;
            $forecast->save();

            // dd($forecast->forecastProduct);
            $forecast->forecastProduct()->delete();

            $forecastProduct = [];
            foreach ($request->material_id as $key => $value) {

                $forecastProduct[] = [
                    'forecast_id' => $forecast->id,
                    'material_id' => $request->material_id[$key],
                    'description' => $request->description[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            ForecastProduct::insert($forecastProduct);

            return redirect()->route('backend.forecast.index')->with(['success' => 'Data berhasil diubah !']);

        } catch (Exception $e) {
            return redirect()->route('backend.forecast.index')->with(['failed' => $e->getMessage()]);
        }
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
