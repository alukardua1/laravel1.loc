<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('metatitle');
            $table->text('keywords');
            $table->string('name')->index();
            $table->string('russian')->index();
            $table->string('original_img')->nullable();
            $table->string('preview_img')->nullable();
            $table->string('url');
            $table->foreignId('kind_id');
            $table->foreignId('channel_id');
            $table->string('status');
            $table->string('broadcast')->nullable();
            $table->string('episodes')->nullable();
            $table->string('episodes_aired')->nullable();
            $table->string('aired_season')->nullable();
            $table->date('aired_on')->nullable();
            $table->date('released_on')->nullable();
            $table->string('rating')->nullable();
            $table->text('english')->nullable()->index();
            $table->text('japanese')->nullable()->index();
            $table->text('synonyms')->nullable()->index();
            $table->string('license_name_ru')->nullable()->index();
            $table->string('duration')->nullable();
            $table->text('description')->nullable()->index();
            $table->text('description_html')->nullable()->index();
            $table->text('description_source')->nullable()->index();
            $table->string('franchise')->nullable();
            $table->boolean('anons')->default(0);
            $table->boolean('ongoing')->default(0);
            $table->boolean('blocking')->default(0);
            $table->string('region')->nullable();
            $table->string('player')->nullable();
            $table->string('trailer')->nullable();
            $table->boolean('posted_at')->default(1);
            $table->boolean('posted_rss')->default(1);
            $table->boolean('comment_at')->default(1);
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
        Schema::dropIfExists('animes');
    }
}
