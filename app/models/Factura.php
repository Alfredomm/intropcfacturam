<?php

class Factura extends Basemodel {
	protected $guarded = array();

	public static $rules = array();

	public function facturalineas() {
		return $this->hasMany('Facturalinea');
	}

	public function cliente() {
		return $this->belongsTo('Cliente');
	}
}
