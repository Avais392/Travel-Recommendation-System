<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelInfo extends Model
{
    //
    public function travelType()
    {
        return $this->belongsTo( 'App\TravelType', 'travelTypeID', 'id' );
    }
}
