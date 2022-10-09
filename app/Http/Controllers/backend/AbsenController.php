<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AbsenController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Absen List';
        $data['absen'] = Absen::get();

        return view('backend.absen.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Absen List';
        $data['absen'] = Absen::get();

        return view('backend.absen.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
           
        ]);
        // $data_uri = $request->signature;
        // $encoded_image = explode(",", $data_uri)[1];
        // $decoded_image = base64_decode($encoded_image);

        // $signature = strtolower($request->name);
        // $signature = Str::random(20);
        $absen = new Absen();
        $absen->name = $request->name;
        $absen->date = $request->date;
        $absen->site = $request->site;
        $absen->description = $request->description;
        // $absen->ttd = $signature;
        
        $absen->save();
        // Storage::put('public/'.$signature.'.jpg', $decoded_image);

        return redirect()->route('backend.absen.index')->with('success','Absen created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Absen User';
        $data['breadcumb'] = 'Absen User';
        $data['absen'] = Absen::findOrFail($id);

        return view('backend.absen.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'date'   => 'required',
        ]);


        $absen = Absen::findOrFail($id);
        if ($request->signature) {
            # code...
            $data_uri = $request->signature;
            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);
            
            $signature = strtolower($request->name);
            $signature = Str::random(20);
            $absen->ttd = $signature;
            Storage::put('public/'.$signature.'.jpg', $decoded_image);
        }

        $absen->name = $request->name;
        $absen->date = $request->date;
        $absen->site = $request->site;
        $absen->description = $request->description;
        
        $absen->save();

        return redirect()->route('backend.absen.index')->with(['success' => 'Absen edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $absen = Absen::findOrFail($id);
            $absen->delete();
        });
        
        Session::flash('success', 'Absen deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
