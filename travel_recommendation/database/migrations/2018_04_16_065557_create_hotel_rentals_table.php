<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rentals', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'hotelID' );
            $table->foreign( 'hotelID' )->references( 'id' )->on( 'hotel_or_restaurants' )->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->string( 'roomType' );
            $table->text( 'roomDescription' );
            $table->float( 'rentPerDay' );
            $table->boolean( 'isDefault' );


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
        Schema::dropIfExists('hotel_rentals');
    }
}
