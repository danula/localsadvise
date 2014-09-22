<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		User::create(array(
			'name'     => 'Danula Eranjith',
			'email'    => 'hmdanulae@gmail.com',
			'password' => Hash::make('awesome'),
		));
	}

}
