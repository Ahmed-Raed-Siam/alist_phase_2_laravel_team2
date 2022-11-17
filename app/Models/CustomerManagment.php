<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerManagment extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['customer_image','shop_owner_name','supermarket_name','address','mobile','email','total_point'];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute(){

        return config('app.url').'/storage/'.$this->customer_image;



    }


    public function scopeSearch($query, $request)
    {


        $query->when($request->shop_owner_name , function($query , $shop_owner_name){
            $query->where('shop_owner_name' ,'like' , '%'. $shop_owner_name .'%');
        });

    }


    public function scopeSort($query, $request)
    {
    }




    public function fromtransfer() {
        return $this->hasMany(PointsTransfer::class, 'from');
    }

    public function totransfer() {
      return $this->hasMany(PointsTransfer::class,  'to');
    }
}
