<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InventoryMaterial;
use App\Models\InventoryProduct;
use Illuminate\Http\Request;

class CutOffController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = 'Cut Off List';
        // return view('backend.cut-off.index', $data);
        if ($request->start_date) {
            $date_from_raw = date('Y-m-d', strtotime($request->start_date));
            // $date_from_raw = ('2021-10-24 14:17:35');
            $date_from = $date_from_raw;
            $date_to_raw = date('Y-m-t', strtotime($request->to_date));
            // $date_to_raw = date('2022-10-24 14:17:35');
            $date_to = $date_to_raw;
            $inventory_product = Inventorymaterial::whereBetween('created_at', [$date_from, $date_to])->delete();
        }else{
            $now = date('Y-m');
            $date_from_raw = date('Y-m-d', strtotime($now));
            $date_from = $date_from_raw;
            $date_to_raw = date('Y-m-t', strtotime($now));
            $date_to = $date_to_raw;
            $inventory_product = InventoryProduct::whereBetween('created_at', [$date_from, $date_to])->delete();
        }
        $data['inventory_product'] = $inventory_product;
        return view('backend.cut-off.index', $data);
    }
}
