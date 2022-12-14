<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPoint extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function order(){
       return $this->belongsTo(OrdersProduct::class);
    }

    public function  customer(){
       return $this->belongsTo(CustomerManagment::class);
    }

    public function scopeSearch($query, $request)
    {
        $query->when(auth('sanctum')->user(), function ($query, $data) {
            $query->where('customer_id', '=',  auth('sanctum')->user()->customer->id);
        });

    }


    public function scopeSort($query, $request)
    {
    }
}
