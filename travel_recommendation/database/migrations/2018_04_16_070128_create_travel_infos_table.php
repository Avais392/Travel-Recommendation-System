<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_infos', function (Blueprint $table) {
            $table->increments('id');



            $table->unsignedInteger( 'destinationID' );

            $table->foreign( 'destinationID' )
                ->references( 'id' )
                ->on( 'destinations' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->string( 'title' )->nullable();

            $table->text( 'description' );

            $table->unsignedInteger( 'travelTypeID' );
            $table->unsignedInteger( 'attractionID' )->nullable();


            $table->foreign( 'travelTypeID' )
                ->references( 'id' )
                ->on( 'travel_types' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );


            $table->foreign( 'attractionID' )
                ->references( 'id' )
                ->on( 'attractions' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );


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
        Schema::dropIfExists('travel_infos');
    }
}
