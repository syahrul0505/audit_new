<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutProduct extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'stock_out_product';
    

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
