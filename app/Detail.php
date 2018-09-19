<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'product_id',
        'purchase_order_id',
        'quantity',
        'tax_percentage',
        'value',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class);
    }
}
