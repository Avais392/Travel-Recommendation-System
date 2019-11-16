<?php

use Illuminate\Database\Seeder;

use App\Destination;
use App\HotelOrRestaurantFeature;
use App\Feature;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dest = new Destination();

        $dest->name = "Kaula Lampur";
        $dest->description = "Desc";
        $dest->rating = 0;


        $dest->save();


        $lastID = Destination::orderBy( 'created_at', 'desc' )->first();

        $allFeatures = Feature::all();


        foreach ( $allFeatures as $feature )
        {

            $HRFeature = new HotelOrRestaurantFeature();

            $HRFeature->hotelOrRestaurantID  = $lastID;
            $HRFeature->featureID = $feature->id;

            $HRFeature->save();
        }
    }
}
