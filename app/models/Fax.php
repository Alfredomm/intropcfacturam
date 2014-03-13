<?php

class Fax extends Basemodel {
	protected $table = 'faxs';

	protected $guarded = array();

	public static $rules = array(
			'nombreFax' => 'required',
			'fax' => 'required'
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
