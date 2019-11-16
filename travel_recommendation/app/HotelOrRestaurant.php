<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelOrRestaurant extends Model
{
    public function destination()
    {
        return $this->belongsTo('App\Destination', 'destinationID', 'id' );
    }

    public function attraction()
    {
        return $this->belongsTo('App\Attraction', 'attractionID', 'id' );
    }

    public function reviews()
    {
        return $this->hasMany( 'App\HotelOrRestaurantReview', 'hotelOrRestaurantID', 'id' );
    }

    public function stars( $number )
    {
        $totalNumOfReviews = $this->reviews()->count();
        $totalStars =  $this->reviews()->where( 'rating', '=', $number )->count() ;

        if ( $totalNumOfReviews > 0 )
        {
            $percentage = $totalStars / $totalNumOfReviews;
        }
        else
        {
            $percentage = 0;
        }

        return [ $percentage, $totalStars ];
    }


    public function deals()
    {
        return $this->hasMany( 'App\Deal', 'hotelOrRestaurantID', 'id' );
    }

    public function features()
    {
        return $this->hasMany( 'App\HotelOrRestaurantFeature', 'hotelOrRestaurantID', 'id' );
    }
}
