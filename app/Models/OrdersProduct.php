<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'order_number', 'total_items','total', 'driver_id', 'order_status_id', 'evaluation','customer_id'
    ];

    public function cases()
    {
        return $this->belongsTo(OrderCases::class, 'order_status_id', 'id');
    }
    public function drivers()
    {
        return $this->belongsTo(DeliveryDrivers::class, 'driver_id', 'id');
    }
    public function customers()
    {
        return $this->belongsTo(CustomerManagment::class, 'customer_id', 'id');
    }
    public function items()
    {
        return $this->hasMany(OrdersProductDetail::class, 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,         // Related Model
            'orders_product_details',      // Pivot Table
            'order_id',       // F.K. in the pivot table for the current model
            'product_id',           // F.K. in the pivot table for related model
            'id',               // P.K in the current model
            'id'                 // P.K. in the related model
        );
    }
}
