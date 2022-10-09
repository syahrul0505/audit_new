<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Absen; 

class Report implements FromView

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $id = $this->id; 
        return view('backend.report.index', [
            'absen' =>  Absen::get()
        ]);
    }
}
