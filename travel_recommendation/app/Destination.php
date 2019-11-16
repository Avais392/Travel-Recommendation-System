<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    public function images()
    {
        return $this->hasMany( 'App\DestinationImage', 'destinationID', 'id' );
    }

    public function attractions()
    {
        return $this->hasMany( 'App\Attraction', 'destinationID', 'id' );
    }

    public function travelInformations()
    {
        return $this->hasMany( 'App\TravelInfo', 'destinationID', 'id' );
    }

    public function hotelsOrRestaurants()
    {
        return $this->hasMany( 'App\HotelOrRestaurant', 'destinationID', 'id' );
    }
}
