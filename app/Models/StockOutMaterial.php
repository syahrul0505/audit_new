<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutMaterial extends Model
{
    use HasFactory;

    protected $table = 'stock_out_material';
    

    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
