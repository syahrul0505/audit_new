<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMaterial extends Model
{
    use HasFactory;

    protected $table = 'inventory_material';
    
    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function stockIncoming($id)
    {
        $material = Material::findOrFail($id);
        $stock_in = $material->stockInMaterial->sum('material_incoming');
        return $stock_in;
    }
    public function stockOutgoing($id)
    {
        $material = Material::findOrFail($id);
        $stock_out = $material->stockOutMaterial->sum('material_outgoing');
        return $stock_out;
    }

   public function totalStock($id)
   {
        $material = Material::findOrfail($id);
        $begin = $material->inventoryMaterial->begin_stock;
        $incoming = $material->stockInmaterial->sum('material_incoming');
        $outgoing = $material->stockOutMaterial->sum('material_outgoing');
        $result = $begin + $incoming - $outgoing;
        return $result;
   }

   public function stok_tersedia($id)
    {
        $material = Material::findOrfail($id);
        $begin = $material->inventorymaterial->begin_stock;
        $incoming = $material->stockInmaterial->sum('material_incoming');
        $outgoing = $material->stockOutmaterial->sum('material_outgoing');

        $total_stock = ($begin + $incoming) - $outgoing ;

        return $total_stock;
    }
}
