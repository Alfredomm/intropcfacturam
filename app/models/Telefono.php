<?php

class Telefono extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
			'nombreTlf' => 'required',
			'telefono' => 'required'
		);

	public function empresas() {
		return $this->belongsToMany('Empresas');
	}

	public function empleados() {
		return $this->belongsToMany('Empleado');
	}

	public function clientes() {
		return $this->belongsToMany('Cliente');
	}
}
