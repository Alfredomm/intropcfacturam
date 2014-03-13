<?php

class Email extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
			'nombreEmail' => 'required',
			'email' => 'required|email'
		);

	public function empresas() {
		return $this->belongsToMany('Empresa');
	}

	public function empleados() {
		return $this->belongsToMany('Empleado');
	}

	public function clientes() {
		return $this->belongsToMany('Cliente');
	}
}
