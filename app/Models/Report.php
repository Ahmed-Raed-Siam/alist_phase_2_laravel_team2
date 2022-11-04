<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'total_outgoing_quantity',
        'number_of_orders',
        'number_of_products',
        'total_price',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
