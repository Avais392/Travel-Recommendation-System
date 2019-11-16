<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelOrRestaurantFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_or_restaurant_features', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'hotelOrRestaurantID' );
            $table->unsignedInteger( 'featureID' );

            $table->foreign( 'hotelOrRestaurantID' )
                ->references( 'id' )->on( 'hotel_or_restaurants' )
                ->onDelete( 'cascade' )->onUpdate( 'cascade' );

            $table->foreign( 'featureID' )->references( 'id' )
                ->on( 'features' )->onDelete( 'cascade' )
                ->onUpdate( 'cascade' );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_or_restaurant_features');
    }
}
