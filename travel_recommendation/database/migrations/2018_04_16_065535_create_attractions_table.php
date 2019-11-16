<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger( 'destinationID' );
            $table->string("name");
            $table->foreign( 'destinationID' )
                ->references( 'id' )
                ->on( 'destinations' )->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->text( 'description' );


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
        Schema::dropIfExists('attractions');
    }
}
