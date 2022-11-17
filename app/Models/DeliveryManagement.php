<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['status_name'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function order()
    {
        return $this->belongsTo(OrdersProduct::class, 'order_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo(DeliveryDrivers::class, 'driver_id', 'id');
    }
    public function scopeSearch($query, $request)
    {
        if ($request->type == 1) {
            $query->when($request->data, function ($query, $data) {
                $query->where('mobile', '=',   $data);
            });
        };
        if ($request->type == 2) {
            $query->when($request->data, function ($query, $data) {
                $order_id = OrdersProduct::where('order_number', $data)->first()->id;

                $query->where('order_id', '=',   $order_id);
            });
        }
    }


    public function scopeSort($query, $request)
    {
    }

    public function getStatusNameAttribute()
    {

        if ($this->status == 1) {
            return 'جاري معالحة الطلب';
        } else if ($this->status == 2) {
            return 'تم اضافة الطلب';
        } else if ($this->status == 3) {
            return 'قيد التوصيل';
        } elseif ($this->status == 4) {
            return  'تم التوصيل';
        }
    }
}
