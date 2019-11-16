<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelOrRestaurantReview extends Model
{
    //

    public function user()
    {
        return $this->belongsTo( 'App\User', 'postedBy', 'id' );
    }

    public function hotelOrRestaurant()
    {
        return $this->belongsTo( 'App\HotelOrRestaurant', 'hotelOrRestaurantID', 'id' );
    }
}
