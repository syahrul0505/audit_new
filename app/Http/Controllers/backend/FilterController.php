<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Filter List';
        $data['breadcumb'] = 'Filter List';
        // $data['users'] = User::orderby('id', 'asc')->get();

        return view('backend.filter.index', $data);
    }

}
