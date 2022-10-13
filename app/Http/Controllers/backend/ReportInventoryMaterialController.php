<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryMaterial;
use App\Exports\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class ReportInventoryMaterialController extends Controller
{
    public function index(Request $request)
    {
        // $data['page_title'] = 'Report List';
        // $data['absen'] = Absen::get();

        // return view('backend.report.index', $data);
        $data['page_title'] = 'Report Inventory Material';
        
        if ($request->start_date) {
            $date_from_raw = date('Y-m-d', strtotime($request->start_date));
            $date_from = $date_from_raw;
            $date_to_raw = date('Y-m-t', strtotime($request->start_date));
            $date_to = $date_to_raw;
            $data['inventory_material'] = InventoryMaterial::whereBetween('created_at', [$date_from, $date_to])->orderBy('id','asc')->get();
        }else{
            $now = date('Y-m');
            $date_from_raw = date('Y-m-d', strtotime($now));
            $date_from = $date_from_raw;
            $date_to_raw = date('Y-m-t', strtotime($now));
            $date_to = $date_to_raw;
            $data['inventory_material'] = InventoryMaterial::whereBetween('created_at', [$date_from, $date_to])->orderBy('id','asc')->get();
        }

        return view('backend.report.report-inventory-material.index', $data);
    }

    public function ReportExport() {  
        $data['inventory_material'] = InventoryMaterial::get();  
        $pdf = Pdf::loadView('backend.report.report-inventory-material.pdf', $data);
        return $pdf->download('Report Inventory Material.pdf');
    }
}
