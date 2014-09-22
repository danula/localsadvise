<?php

class MapTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	public function testDisplayLocations()
	{
		$this->call('GET', 'map');
		$this->assertViewHas('questions');
	}

	public function testAddLocations()
	{
		$this->call('GET','map/add');
	}

	public function testMapLocationRoute(){
		$this->call('GET','map/2');
		$this->assertViewHas('defaultLocation',2);
	}
}
