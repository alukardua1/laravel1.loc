<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnimeCopyrightHolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('anime_copyright_holder', function (Blueprint $table) {
		    $table->id();
		    $table->foreignId('anime_id');
		    $table->foreignId('copyright_holder_id');
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
	    Schema::dropIfExists('anime_copyright_holder');
    }
}
