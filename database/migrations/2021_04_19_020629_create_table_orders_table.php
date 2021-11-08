<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
			'table_orders',
			function (Blueprint $table) {
				$table->id();
				$table->foreignId('user_id');
				$table->string('status')->default('Waiting');
				$table->string('name_rus');
				$table->string('name_origin');
				$table->string('year');
				$table->string('wa_url')->nullable();
				$table->string('kp_url')->nullable();
				$table->string('imdb_url')->nullable();
				$table->string('shikimori_url')->nullable();
				$table->foreignId('translate_id');
				$table->text('download_url');
				$table->softDeletes();
				$table->timestamps();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('table_orders');
	}
}
