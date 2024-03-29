<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttractionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_images', function (Blueprint $table) {
            $table->increments('id');



            $table->unsignedInteger( 'attractionID' );
            $table->foreign( 'attractionID' )
                ->references( 'id' )
                ->on( 'attractions' )->onUpdate( 'cascade' )
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
        Schema::dropIfExists('attraction_images');
    }
}
