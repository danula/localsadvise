<?php


class Question extends Eloquent {

	protected $table = 'questions';

	public function answers()
    {
    	return $this->hasMany('Answer');
    }
}