<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelOrRestaurantReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_or_restaurant_reviews', function (Blueprint $table) {
            $table->increments('id');


            $table->unsignedInteger( 'hotelOrRestaurantID' );
            $table->unsignedInteger( 'postedBy' );

            $table->foreign( 'hotelOrRestaurantID' )
                ->references( 'id' )
                ->on( 'hotel_or_restaurants' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->float( 'rating' );
            $table->text( 'review' );
            $table->foreign( 'postedBy' )->references( 'id' )
                ->on( 'users' )
                ->onDelete( 'cascade' )
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
        Schema::dropIfExists('hotel_or_restaurant_reviews');
    }
}
