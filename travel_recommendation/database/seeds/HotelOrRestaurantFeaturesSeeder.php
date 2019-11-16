<?php

use Illuminate\Database\Seeder;
use App\HotelOrRestaurantFeature;

class HotelOrRestaurantFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $feature = new HotelOrRestaurantFeature();

        $feature->hotelOrRestaurantID = 1;
        $feature->featureID = 1;

        $feature->save();



        $feature = new HotelOrRestaurantFeature();

        $feature->hotelOrRestaurantID = 1;
        $feature->featureID = 2;

        $feature->save();

    }
}
