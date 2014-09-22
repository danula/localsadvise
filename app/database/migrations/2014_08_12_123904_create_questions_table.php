<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function($table)
		{
		    $table->increments('questionId');
        	$table->string('questionText');
        	$table->integer('userId')->unsigned();
        	$table->integer('locationId')->unsigned();
			$table->foreign('userId')->references('id')->on('users');
			$table->foreign('locationId')->references('locationId')->on('locations');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}
