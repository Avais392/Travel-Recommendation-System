<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    public function images()
    {
        return $this->hasMany('App\HotelOrRestaurantDealImage', 'hotelOrRestaurantDealID', 'id');
    }
}
