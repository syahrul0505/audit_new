<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => 'dashboard']);
    }

    public function dashboard()
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';

        return view('backend.dashboard.index', $data);
    }
    
   
}
