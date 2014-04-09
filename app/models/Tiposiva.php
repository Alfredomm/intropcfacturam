<?php

class Tiposiva extends Basemodel {
	protected $guarded = array();

	public static $rulesUpdate = array(
		'tipo' => 'required|alpha_num',
		'iva' => 'required|numeric'
	);

	public static $rules = array(
		'tipo' => 'required|alpha_num',
		'iva' => 'required|numeric'
	);
}
