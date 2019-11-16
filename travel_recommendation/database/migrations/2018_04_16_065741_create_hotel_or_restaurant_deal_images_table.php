<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelOrRestaurantDealImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_or_restaurant_deal_images', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'hotelOrRestaurantDealID' );

            $table->foreign( 'hotelOrRestaurantDealID' )
                ->references( 'id' )
                ->on( 'deals' )
                ->onDelete( 'cascade' )
                ->onUpdate( 'cascade' );

            $table->string( 'path' );

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
        Schema::dropIfExists('hotel_or_restaurant_deal_images');
    }
}
