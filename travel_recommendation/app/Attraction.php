<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    //
    public function image()
    {
        return $this->hasMany( 'App\AttractionImage', 'attractionID', 'id' );
    }
}
