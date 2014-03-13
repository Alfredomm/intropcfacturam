<?php

class Basemodel extends Eloquent {
	
	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public static function validateUpdate($data) {
		return Validator::make($data, static::$rulesUpdate);
	}

	public static function validateNewPoblacion($data) {
		return Validator::make($data, static::$rulesNewPoblacion);
	}
}