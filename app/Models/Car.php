<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['license_plate', 'car_type', 'parked_at', 'location_id', 'car_type_image'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getCarTypeImageUrlAttribute()
{
    
    if ($this->car_type_image) {
        return asset('storage/car_images/' . $this->car_type_image);
    }

    return asset('images/default_car_image.png'); 
}

}
