<?php

use Illuminate\Database\Seeder;
use App\TravelType;

class TravelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $travelType = new TravelType();
        $travelType->name = "Airline";
        $travelType->save();

        $travelType = new TravelType();
        $travelType->name = "Train";
        $travelType->save();


        $travelType = new TravelType();
        $travelType->name = "Bus";
        $travelType->save();


        $travelType = new TravelType();
        $travelType->name = "Traveling agency";
        $travelType->save();

    }
}
