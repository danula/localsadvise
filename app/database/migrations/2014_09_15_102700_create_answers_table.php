<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function($table)
		{
		    $table->increments('answerId');
        	$table->string('answerText');
        	$table->integer('userId')->unsigned();
        	$table->integer('locationId')->unsigned();
        	$table->integer('questionId')->unsigned();
        	$table->timestamps();
			$table->foreign('userId')->references('id')->on('users');
			$table->foreign('locationId')->references('locationId')->on('locations');
			$table->foreign('questionId')->references('questionId')->on('questions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers');
	}

}
