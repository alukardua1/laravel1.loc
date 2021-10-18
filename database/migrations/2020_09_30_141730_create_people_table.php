<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
	        $table->id();
	        $table->string('name')->index();
	        $table->string('russian')->nullable();
	        $table->string('japanese')->nullable();
	        $table->string('original_img')->default('/images/missing_original.jpg');
	        $table->string('url');
	        $table->date('birthday')->nullable();
	        $table->string('website')->nullable();
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
        Schema::dropIfExists('people');
    }
}
