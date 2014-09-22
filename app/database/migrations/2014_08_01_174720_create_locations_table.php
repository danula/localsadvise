<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function($table)
		{
		    $table->increments('locationId');
        	$table->string('locationName');
        	$table->string('category');
        	$table->float('longitude');
        	$table->float('latitude');
        	$table->integer('zoomLevel');
        	$table->integer('numberOfQuestions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
