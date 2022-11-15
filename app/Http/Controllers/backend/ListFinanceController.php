<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListFinanceController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'List Finance';
        // $data['purchase_order'] = PurchaseOrder::get();

        return view('backend.list-finance.index', $data); 
    }

    public function create()
    {
        $data['page_title'] = 'Finance Create';
        // $data['purchase_order'] = PurchaseOrder::get();

        return view('backend.list-finance.create', $data);
    }
}
