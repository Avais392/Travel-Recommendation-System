<?php

use Illuminate\Database\Seeder;
use App\Deal;
use App\HotelOrRestaurantDealImage;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $deal = new Deal();

        $deal->hotelOrRestaurantID = 1;
        $deal->title = "Deal 1";
        $deal->description = "Dummy desc";
        $deal->price = "1000";

        $dealImage = new HotelOrRestaurantDealImage();

        $deal->save();
        $dealImage->hotelOrRestaurantDealID = Deal::orderBy( 'created_at', 'desc' )->first()->id;
        $dealImage->path = "deal_images/defaultDealImage.png";

        $dealImage->save();






        $deal = new Deal();

        $deal->hotelOrRestaurantID = 1;
        $deal->title = "Deal 2";
        $deal->description = "Dummy desc 2";
        $deal->price = "1000";

        $dealImage = new HotelOrRestaurantDealImage();

        $deal->save();
        $dealImage->hotelOrRestaurantDealID = 2;
        $dealImage->path = "deal_images/defaultDealImage.png";

        $dealImage->save();
    }
}
