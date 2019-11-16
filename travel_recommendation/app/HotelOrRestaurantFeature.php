<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelOrRestaurantFeature extends Model
{
    //

    public function feature()
    {
        return $this->belongsTo( 'App\Feature', 'featureID', 'id' );
    }
}
