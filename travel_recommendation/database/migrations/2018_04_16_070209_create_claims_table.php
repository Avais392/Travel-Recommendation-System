<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');


            $table->unsignedInteger( 'hotelID' );
            $table->unsignedInteger( 'claimedBy' );

            $table->foreign( 'hotelID' )->references( 'id' )->on( 'hotel_or_restaurants' )->onDelete( 'cascade' )->onUpdate( 'cascade' );

            $table->foreign( 'claimedBy' )->references( 'id' )
                ->on( 'hotel_or_restaurants' )
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
        Schema::dropIfExists('claims');
    }
}
