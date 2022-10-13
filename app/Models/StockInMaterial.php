<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInMaterial extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'stock_in_material';
    

    protected $guarded = [];

    public function Material()
    {
        return $this->belongsTo(Material::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
