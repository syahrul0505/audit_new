<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Warehouse List';
        // $data['stock_in'] = StockInMaterial::get();
        
        return view('backend.inventory.warehouse.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Warehouse Create';
        // $data['product'] = Product::get();
        
        // dd($data['product']);
        return view('backend.inventory.warehouse.create', $data);
    }
}
