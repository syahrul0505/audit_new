<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class EmployeeController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Employee List';
        $data['employee'] = Employee::get();

        return view('backend.master-data.employee.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Employee List';
        $data['employee'] = Employee::get();

        return view('backend.master-data.employee.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'nullable',
            'name' => 'required',
            'npwp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            "upload_ktp" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:5000",
            "upload_npwp" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:5000",
            "upload_cv" => "required|mimes:jpeg,jpg,png,pdf|max:10000",
            "upload_document" => "required|mimes:jpeg,jpg,png,pdf,xlsx,docx|max:10000",
            // "upload_cv" => "required|mimetypes:application/pdf|max:10000|size:10000|image|mimes:jpeg,png,jpg,gif,svg",
           
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->nik = $request->nik;
        $employee->npwp = $request->npwp;
        $employee->jenis_kelamin = $request->jenis_kelamin;
        $employee->tanggal_lahir = $request->tanggal_lahir;
        $employee->alamat = $request->alamat;
        $employee->no_hp = $request->no_hp;
        $employee->description = $request->description;

        if ($request->hasFile('upload_ktp')) {
            $image = $request->file('upload_ktp');
            $name = 'ktp' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_ktp = $name;
        }

        if ($request->hasFile('upload_npwp')) {
            $image = $request->file('upload_npwp');
            $name = 'npwp' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_npwp = $name;
        }

        if ($request->hasFile('upload_cv')) {
            $image = $request->file('upload_cv');
            $name = 'cv' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_cv = $name;
        }
        
        $employee->save();

        return redirect()->route('backend.employee.index')->with('success','Employee created successfully');
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Employee';
        $data['breadcumb'] = 'Edit Employee';
        $data['employee'] = Employee::findOrFail($id);

        return view('backend.master-data.employee.edit', $data);
    }

    public function downloadImage(Request $request)
    {
        $filepath = public_path('img/employee/');
        return Response::download($filepath);
    }

    // public function show($id)
    // {
    //     $data['employee'] = Employee::findOrFail($id);
    //     $data['tes'] = Employee::get();

    //     return view('backend.master-data.employee.show', $data);
    // }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nik'   => 'nullable',
            'description' => 'nullable',
            'nik' => 'nullable',
            'name' => 'required',
            'npwp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            "upload_ktp" => "nullable|image|mimes:jpeg,png,jpg|max:5000",
            "upload_npwp" => "nullable|image|mimes:jpeg,png,jpg|max:5000",
            "upload_cv" => "nullable|mimes:jpeg,jpg,png,pdf|max:10000",
            "upload_document" => "nullable|mimes:jpeg,jpg,png,pdf,xlsx,docx|max:10000",
        ]);

        $employee = Employee::findOrFail($id);
        $employee->nik = $request->nik;
        $employee->name = $request->name;
        $employee->npwp = $request->npwp;
        $employee->jenis_kelamin = $request->jenis_kelamin;
        $employee->tanggal_lahir = $request->tanggal_lahir;
        $employee->alamat = $request->alamat;
        $employee->no_hp = $request->no_hp;
        $employee->description = $request->description;
        // dd($request->all());
        // Remove KTP if requested
        if ($request->hapus_ktp == 'hapus') {
            $image_path = public_path('img/employee/' . $employee->upload_ktp ); // Value is not URL but directory file path
            // dd($image_path);
            // dd(File::exists($image_path));
            if (File::exists($image_path)) {
                // dd($image_path);
                File::delete($image_path);
                $employee->upload_ktp = null;
            }
        }
        // dd('stop');
        // Remove NPWP if requested
        if ($request->hapus_npwp == 'hapus') {
            $image_path = public_path('img/employee/'.$employee->upload_npwp); // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
                $employee->upload_npwp = null;
            }
        }

        // Remove CV/RESUME if requested
        if ($request->hapus_cv == 'hapus') {
            $image_path = public_path('img/employee/'.$employee->upload_cv); // Value is not URL but directory file path
            // dd($image_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
                $employee->upload_cv = null;
            }
        }

        // Remove Document if requested
        if ($request->hapus_document == 'hapus') {
            $image_path = public_path('img/employee/'.$employee->upload_document); // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
                $employee->upload_document = null;
            }
        }
        // dd("stop");
        if ($request->hasFile('upload_ktp')) {
            // Delete Img
            if ($employee->upload_ktp) {
                $image_path = public_path('img/employee/'.$employee->upload_ktp); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            
            $image = $request->file('upload_ktp');
            $name = 'ktp' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_ktp = $name;
        }

        if ($request->hasFile('upload_npwp')) {
            // Delete Img
            if ($employee->upload_npwp) {
                $image_path = public_path('img/employee/'.$employee->upload_npwp); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            
            $image = $request->file('upload_npwp');
            $name = 'npwp' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_npwp = $name;
        }

        if ($request->hasFile('upload_cv')) {
            // Delete Img
            if ($employee->upload_cv) {
                $image_path = public_path('img/employee/'.$employee->upload_cv); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            
            $image = $request->file('upload_cv');
            $name = 'cv' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_cv = $name;
        }

        if ($request->hasFile('upload_document')) {
            // Delete Img
            if ($employee->upload_document) {
                $image_path = public_path('img/employee/'.$employee->upload_document); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            
            $image = $request->file('upload_document');
            $name = 'document' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/');
            $image->move($destinationPath, $name);
            $employee->upload_document = $name;
        }
        
        $employee->save();

        return redirect()->route('backend.employee.index')->with(['success' => 'employee edited successfully!']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $employee = Employee::findOrFail($id);
            $employee->delete();
        });
        
        Session::flash('success', 'Employee deleted successfully!');
        return response()->json(['status' => '200']);
    }

}
