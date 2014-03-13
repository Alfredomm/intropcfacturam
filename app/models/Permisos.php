<?php

class Permisos extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'permisos' => 'unique:permisos,descripcion'
	);
}
