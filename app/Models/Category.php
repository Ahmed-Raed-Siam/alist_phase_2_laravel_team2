<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'en_name',
        'ar_name',
        'image',
        'main_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'main_id', 'id');
    }

    public function main()
    {
        return $this->belongsTo(Category::class, 'main_id', 'id')->withDefault([
            'name' => 'No main'
        ]);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            if (strpos($this->image, 'http') === 0) {
                return $this->image;
            }
            return asset('public/uploads/' . $this->image);
            //return Storage::disk('uploads')->url($this->image);
        }

        return asset('images/default-image.jpg');
    }
}
