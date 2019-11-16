<?php

use Illuminate\Database\Seeder;
use App\HotelOrRestaurant;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $hotel = new HotelOrRestaurant();

        $hotel->type = "Hotel";
        $hotel->name = "Dummy hotel";
        $hotel->destinationID = 1;
        $hotel->attractionID = 1;
        $hotel->description = "Dummy desc";
        $hotel->phone = "0322-4499372";
        $hotel->fax = "123-123-123";
        $hotel->email = "Dummy email";
        $hotel->website = "Dummy website";
        $hotel->rating = 3;
        $hotel->createdBy = 1;
        $hotel->rentPerDay = 2500;
        $hotel->pic = "hotel_images/hotel.jpg";

        $hotel->save();
    }
}
