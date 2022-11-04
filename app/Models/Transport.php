<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'driver_image',
        'driver_name',
        'vehicle_type',
        'plate_number',
    ];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return config('app.url') .
            '/storage/' .
            $this->driver_image;
    }
}
