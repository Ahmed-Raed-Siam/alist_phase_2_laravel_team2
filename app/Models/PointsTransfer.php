<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PointsTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function point_from_customer(){
      return  $this->belongsTo(CustomerManagment::class ,'from');
    }
    public function point_to_customer(){
      return  $this->belongsTo(CustomerManagment::class ,'to');
    }

    public function scopeSearch($query, $request)
    {

    }


    public function scopeSort($query, $request)
    {
    }

}
