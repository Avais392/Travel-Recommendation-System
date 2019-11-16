<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelOrRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hotel_or_restaurants');
        Schema::create('hotel_or_restaurants', function (Blueprint $table) {
            $table->increments('id');


            $table->enum( 'type', [ 'Hotel', 'Restaurant' ] );
            $table->decimal('longitude', 8, 2 )->nullable();
            $table->decimal('latitude', 8, 2 )->nullable();
            $table->string( 'name' );
            $table->unsignedInteger('destinationID' );
            $table->unsignedInteger('attractionID' )->nullable();
            $table->text('description');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->float('rating');
            $table->unsignedInteger('createdBy' )->nullable();
            $table->string('pic' );
            $table->float( 'rentPerDay' )->nullable();


            $table->foreign( 'destinationID' )->references( 'id' )->on( 'destinations' )->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->foreign( 'attractionID' )->references( 'id' )->on( 'attractions' )->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->foreign('createdBy')->references( 'id' )->on('users')->onDelete( 'cascade' )->onUpdate( 'cascade' );

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
        Schema::dropIfExists('hotel_or_restaurants');
    }
}
