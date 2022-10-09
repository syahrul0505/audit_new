<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Absen; 

class JobDetailImport implements FromView
{
    /**
    * @param Collection $collection
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
