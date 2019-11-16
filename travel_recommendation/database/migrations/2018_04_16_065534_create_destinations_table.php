<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');

            $table->string( 'name' );
            $table->decimal('longitude', 8, 2 )->nullable();
            $table->decimal('latitude', 8, 2 )->nullable();
            $table->text('description');
            $table->float('rating');
            $table->unsignedInteger( 'createdBy' )->nullable();
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
        Schema::dropIfExists('destinations');
    }
}
