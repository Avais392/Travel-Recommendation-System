<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function hotelsOrRestaurants()
    {
        return $this->hasMany('App\HotelOrRestaurant', 'createdBy', 'id');
    }

    public function reviews()
    {
        return $this->hasMany( 'App\HotelOrRestaurantReview', 'postedBy', 'id' );
    }
}
