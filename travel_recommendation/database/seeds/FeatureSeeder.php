<?php

use Illuminate\Database\Seeder;
use App\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $feature = new Feature();

        $feature->name = "Wifi";
        $feature->save();



        $feature = new Feature();

        $feature->name = "Parking";
        $feature->save();
    }
}
