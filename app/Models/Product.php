<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'product_picture',
        'product_name',
        'product_date',
        'product_price',
        'product_barcode',
        'produect_unit',
        'status',
        'product_details',
        'category_id',

    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function getImageUrlAttribute()
    {
        if ($this->product_picture) {
            if (strpos($this->product_picture, 'http') === 0) {
                return $this->product_picture;
            }
            return asset('public/uploads/' . $this->product_picture);
            //return Storage::disk('uploads')->url($this->image);
        }

        return asset('images/default-image.jpg');
    }
}
