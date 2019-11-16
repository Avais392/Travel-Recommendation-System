<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DestinationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(TravelTypeSeeder::class);
        $this->call(AttractionSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(DealSeeder::class);
        $this->call(HotelOrRestaurantFeaturesSeeder::class);
        $this->call(TravelInfoSeeder::class);
    }
}
