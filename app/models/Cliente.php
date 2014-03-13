<?php

class Cliente extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'nombre' => 'required|unique:clientes'
	);

	public static $rulesUpdate = array(
		'nombre' => 'required',
		'postalcodigo_id' => 'required|integer|min:1'
	);

	public function empresa() {
		return $this->belongsTo('Empresa');
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

	public function facturas(){
		return $this->hasMany('Factura');
	}
}
