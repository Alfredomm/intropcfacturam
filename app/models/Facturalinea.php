<?php

class Facturalinea extends Basemodel {
	protected $guarded = array();

	public static $rules = array(
		'cantidad_material' => 'numeric',
		'precio' => 'numeric'
	);

	public function material() {
		return $this->belongsTo('Material');
	}

	public function factura() {
		return $this->belongsTo('Factura');
	}
}
