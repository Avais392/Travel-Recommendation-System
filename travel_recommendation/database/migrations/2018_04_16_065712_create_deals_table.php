<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'hotelOrRestaurantID' );

            $table->string( "title" );

            $table->foreign( 'hotelOrRestaurantID' )
                ->references( 'id' )
                ->on( 'hotel_or_restaurants' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->text( 'description' )->nullable();

            $table->float( 'price' );


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
        Schema::dropIfExists('deals');
    }
}
