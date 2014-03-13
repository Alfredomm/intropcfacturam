<?php

class Tipo extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'tipo' => 'unique:tipos,descripcion'
	);
}
