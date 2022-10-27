<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastProduct extends Model
{
    use HasFactory;

    protected $table = 'forcast_product';
    
    protected $guarded = [];

    public function forecast()
    {
        return $this->belongsTo(Forecast::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    
}
