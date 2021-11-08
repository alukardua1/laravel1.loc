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
	        $table->foreignId('kind_id');
	        $table->foreignId('channel_id')->default(0);
	        $table->foreignId('user_id');
	        $table->foreignId('aired_season')->default(0);
	        $table->foreignId('rating_id')->default(1);
	        $table->text('metatitle');
	        $table->text('keywords');
	        $table->string('url');
	        $table->string('name')->index();
	        $table->string('russian')->index();
	        $table->string('english')->nullable()->index();
	        $table->string('japanese')->nullable()->index();
	        $table->text('synonyms')->nullable();
	        $table->string('license_name_ru')->nullable()->index();
	        $table->text('original_img')->nullable();
	        $table->text('preview_img')->nullable();
	        $table->string('broadcast')->nullable();
	        $table->string('episodes')->nullable();
	        $table->string('episodes_aired')->nullable();
	        $table->string('duration')->nullable();
	        $table->string('read_count')->default(0);
	        $table->string('reason_edit')->nullable();
	        $table->date('aired_on')->nullable();
	        $table->date('released_on')->nullable();
	        $table->dateTime('next_episode_at')->nullable();
	        $table->text('description')->nullable();
	        $table->boolean('anons')->default(0);
	        $table->boolean('ongoing')->default(0);
	        $table->boolean('released')->default(1);
	        $table->boolean('posted_at')->default(1);
	        $table->boolean('posted_main_page')->default(1);
            $table->boolean('posted_rss')->default(1);
            $table->boolean('comment_at')->default(1);
	        $table->softDeletes();
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
