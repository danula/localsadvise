<?php


class Location extends Eloquent {

	protected $table = 'locations';
	public function questions()
    {
        return $this->hasMany('Question');
    }
    public function answers()
    {
    	return $this->hasMany('Answer');
    }

}