<?php

class Empresa extends Basemodel {
	
	protected $guarded = array();

	public static $rules = array();

	public function clientes() {
		return $this->hasMany('Cliente');
	}

	public function empleados() {
		return $this->hasMany('Empleado');
	}

	public function telefonos() {
		return $this->belongsToMany('Telefono');
	}

	public function faxs() {
		return $this->belongsToMany('Fax');
	}

	public function emails() {
		return $this->belongsToMany('Email');
	}

	public function postalcodigo() {
		return $this->belongsTo('Postalcodigo');
	}

}
