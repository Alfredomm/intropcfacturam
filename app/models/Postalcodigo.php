<?php

class Postalcodigo extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'codigo_postal' => 'required|digits:5|unique:postalcodigos,codigo_postal',
		'poblacion' => 'required|unique:postalcodigos,poblacion',
		'provincia' => 'required|unique:postalcodigos,provincia'
	);

	public static $rulesUpdate = array(
		'codigo_postal' => 'required|digits:5',
		'poblacion' => 'required',
		'provincia' => 'required'
	);

	public static $rulesNewPoblacion = array(
		'codigo_postal' => 'required|digits:5|unique:postalcodigos,codigo_postal',
		'poblacion' => 'required|unique:postalcodigos,poblacion'
	);

	public function empleados() {
		return $this->hasMany('Empleado');
	}

	public function empresas() {
		return $this->hasMany('Empresa');
	}

	public function clientes() {
		return $this->hasMany('Cliente');
	}
}
