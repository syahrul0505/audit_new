<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absen;
use App\Exports\Report; 
use Maatwebsite\Excel\Facades\Excel;



class ReportController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Report List';
        $data['absen'] = Absen::get();

        return view('backend.report.index', $data);
    }

    public function ReportExport(Request $request) {  
        // dd($request->all()); 
        return Excel::download(new Report($request), 'Report.xlsx');
    }
}
