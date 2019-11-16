<?php

use Illuminate\Database\Seeder;
use App\Attraction;
use App\Destination;
use App\AttractionImage;

class AttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dest = Destination::orderBy( 'id', 'desc' )->first();


        $attraction = new Attraction();
        $attraction->name = "Dummy Attraction";
        $attraction->destinationID = $dest->id;
        $attraction->description = "Hello world!";

        $attraction->save();

        $attrImage = new AttractionImage();

        $attrImage->attractionID = 1;
        $attrImage->path = "attraction_images/defaultAttraction.jpg";

        $attrImage->save();


    }
}
