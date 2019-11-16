<?php

use Illuminate\Database\Seeder;
use App\HotelOrRestaurantReview;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $review = new HotelOrRestaurantReview();

        $review->hotelOrRestaurantID = 1;
        $review->rating = 3;
        $review->review = "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.";

        $review->postedBy = 1;

        $review->save();







        $review = new HotelOrRestaurantReview();

        $review->hotelOrRestaurantID = 1;
        $review->rating = 3;
        $review->review = "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                                Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the 1914 translation by H. Rackham.";

        $review->postedBy = 1;

        $review->save();


    }
}
