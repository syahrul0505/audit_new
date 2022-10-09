<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    use HasFactory;

    protected $table = 'inventory_product';
    
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

   public function totalStock($id)
   {
        $product = Product::findOrfail($id);
        $begin = $product->inventoryProduct->begin_stock;
        $incoming = $product->stockInProduct->sum('product_incoming');
        // $outgoing = $product->stockInProduct->sum('product_outgoing');
        $result = $begin + $incoming;
        return $result;
   }
}
