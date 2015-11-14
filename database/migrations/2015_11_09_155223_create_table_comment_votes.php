<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCommentVotes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('posts_id')->unsigned();
			$table->integer('comments_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('vote');
			$table->timestamps();

			$table->foreign('posts_id')
				->references('id')
				->on('posts')
				->onDelete('cascade');

			$table->foreign('comments_id')
				->references('id')
				->on('comments')
				->onDelete('cascade');

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment_votes');
	}

}
