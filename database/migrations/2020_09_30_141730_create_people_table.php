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
            $table->string('original_img')->nullable();
            $table->string('preview_img')->nullable();
            $table->string('url');
            $table->string('japanese')->nullable();
            $table->date('birthday');
            $table->string('website')->nullable();
            $table->boolean('producer')->default(0);
            $table->boolean('mangaka')->default(0);
            $table->boolean('seyu')->default(0);
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
