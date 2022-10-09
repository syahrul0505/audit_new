<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    

    protected $guarded = [];

    public function stockInProduct()
    {
        return $this->hasMany(StockInProduct::class);
    }

    public function inventoryProduct()
    {
        return $this->hasOne(InventoryProduct::class);
    }
}
