<?php

class Empleado extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'nombre' => 'required|unique:empleados',
		'dni' => 'alpha_num'
	);

	public function telefonos() {
		return $this->belongsToMany('Telefono');
	}

	public function faxs() {
		return $this->belongsToMany('Fax');
	}

	public function emails() {
		return $this->belongsToMany('Email');
	}

	public function empresa() {
		return $this->belongsTo('Empresa');
	}

	public function postalcodigo() {
		return $this->belongsTo('Postalcodigo');
	}
}
