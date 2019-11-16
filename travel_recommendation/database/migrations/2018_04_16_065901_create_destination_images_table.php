<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_images', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'destinationID' );
            $table->foreign( 'destinationID' )
                ->references( 'id' )
                ->on( 'destinations' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

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
        Schema::dropIfExists('destination_images');
    }
}
