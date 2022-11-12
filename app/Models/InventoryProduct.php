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

    public function forecast()
    {
        return $this->belongsTo(Forecast::class);
    }
    
    public function stockIncoming($id)
    {
        $product = product::findOrFail($id);
        $stock_in = $product->stockInProduct->sum('product_incoming');
        return $stock_in;
    }
    public function stockOutgoing($id)
    {
        $product = product::findOrFail($id);
        $stock_out = $product->stockOutProduct->sum('product_outgoing');
        return $stock_out;
    }

   public function totalStock($id)
   {
        $product = Product::findOrfail($id);
        $begin = $product->inventoryProduct->begin_stock;
        $incoming = $product->stockInProduct->sum('product_incoming');
        $outgoing = $product->stockOutProduct->sum('product_outgoing');
        $result = $begin + $incoming - $outgoing;
        return $result;
   }

   public function stok_tersedia($id)
    {
        $product = Product::findOrfail($id);
        $begin = $product->inventoryProduct->begin_stock;
        $incoming = $product->stockInProduct->sum('product_incoming');
        $outgoing = $product->stockOutProduct->sum('product_outgoing');

        $total_stock = ($begin + $incoming) - $outgoing;

        return $total_stock;
    }
}
