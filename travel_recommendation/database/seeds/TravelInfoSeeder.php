<?php

use Illuminate\Database\Seeder;
use App\TravelInfo;

class TravelInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tt = new TravelInfo();

        $tt->destinationID = 1;
        $tt->attractionID = null;
        $tt->title = "Private Airline";
        $tt->description = "Private Airline description";
        $tt->travelTypeID = 1;

        $tt->save();






        $tt = new TravelInfo();

        $tt->destinationID = 1;
        $tt->attractionID = null;
        $tt->title = "Private Airline";
        $tt->description = "Private Airline description";
        $tt->travelTypeID = 2;

        $tt->save();





        $tt = new TravelInfo();

        $tt->destinationID = 1;
        $tt->attractionID = null;
        $tt->title = "Private Airline";
        $tt->description = "Private Airline description";
        $tt->travelTypeID = 3;

        $tt->save();







        $tt = new TravelInfo();

        $tt->destinationID = 1;
        $tt->attractionID = null;
        $tt->title = "Private Airline";
        $tt->description = "Private Airline description";
        $tt->travelTypeID = 4;

        $tt->save();
    }
}
