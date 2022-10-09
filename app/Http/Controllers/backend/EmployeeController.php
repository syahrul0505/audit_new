<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
           
        ]);
        $employee = new Employee();
        $employee->nik = $request->nik;
        $employee->name = $request->name;
        $employee->description = $request->description;
        
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


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nik'   => 'nullable',
            'description' => 'nullable',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->nik = $request->nik;
        $employee->name = $request->name;
        $employee->description = $request->description;
        
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
