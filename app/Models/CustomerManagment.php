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
}
