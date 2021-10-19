<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
			'users',
			function (Blueprint $table) {
				$table->id();
				$table->foreignId('country_id')->default(1);
				$table->foreignId('group_id')->default(3);
				$table->foreignId('current_team_id')->nullable();
				$table->string('name')->nullable();
				$table->string('login')->unique()->index();
				$table->string('email')->unique()->index();
				$table->boolean('hide_email')->default(0);
				$table->boolean('allow_mail')->default(0);
				$table->boolean('comments_reply_subscribe')->default(0);
				$table->boolean('anime_subscribe')->default(0);
				$table->string('city')->nullable();
				$table->date('birthday')->nullable();
				$table->string('password');
				$table->rememberToken();
				$table->text('profile_photo_path')->nullable();
				$table->text('description')->nullable();
				$table->text('signature')->nullable();
				$table->boolean('active')->default(1);
				$table->boolean('blocked')->default(0);
				$table->timestamp('blocked_at')->nullable();
				$table->timestamp('email_verified_at')->nullable();
				$table->timestamp('register')->default(date('Y-m-d H:i:s'));
				$table->timestamp('last_login')->default(date('Y-m-d H:i:s'));
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
		Schema::dropIfExists('users');
	}
}
