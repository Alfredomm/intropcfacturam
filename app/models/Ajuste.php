<?php

class Ajuste extends Basemodel {
	protected $guarded = array();

	public static $rulesUpdate = array(
		'iva' => 'required|numeric'
	);

	public static $rules = array();
}
