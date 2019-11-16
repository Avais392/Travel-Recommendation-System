<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_reviews', function (Blueprint $table) {
            $table->increments('id');


            $table->unsignedInteger( 'destinationID' );
            $table->unsignedInteger( 'postedBy' );

            $table->foreign( 'destinationID' )
                ->references( 'id' )
                ->on( 'destinations' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->float( 'rating' );
            $table->text( 'review' );
            $table->foreign( 'postedBy' )->references( 'id' )
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
        Schema::dropIfExists('destination_reviews');
    }
}
