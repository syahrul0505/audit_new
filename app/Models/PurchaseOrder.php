<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    protected $guarded = [];

    public function purchaseOrderPivot()
    {
        return $this->hasMany(PurchaseOrderPivot::class);
    }

    
}
