<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    

    protected $guarded = [];

    public function stockInMaterial()
    {
        return $this->hasMany(StockInMaterial::class);
    }

    public function stockOutMaterial()
    {
        return $this->hasMany(StockOutMaterial::class);
    }

    public function inventoryMaterial()
    {
        return $this->hasOne(InventoryMaterial::class);
    }
}
