<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
	        $table->id();
	        $table->string('name');
	        $table->string('english');
	        $table->string('japanese')->nullable();
	        $table->string('original_img')->nullable();
	        $table->string('preview_img')->nullable();
	        $table->string('url');
	        $table->text('description')->nullable();
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
        Schema::dropIfExists('characters');
    }
}
