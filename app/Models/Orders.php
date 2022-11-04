<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{

    use HasFactory,SoftDeletes;
    protected $fillable = [
        'order_number', 'products_number', 'total', 'driver_id', 'order_status_id', 'evaluation','customer_id'
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
}
