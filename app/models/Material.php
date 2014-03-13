<?php

class Material extends Basemodel {
	protected $guarded = array();

	protected $table = 'materiales';

	public static $rulesUpdate = array(
		'nombre' => 'required',
		'cantidad' => 'numeric',
		'precio_venta' => 'numeric',
		'precio_alquiler' => 'numeric',
		'categoria' => 'required'
	);

	public static $rules = array(
		'nombre' => 'required',
		'cantidad' => 'numeric',
		'precio_venta' => 'numeric',
		'precio_alquiler' => 'numeric',
		'categoria' => 'required|unique:materiales'
	);

	public function facturalineas() {
		return $this->belongsToMany('Facturalinea');
	}

	public function getCategoriaNombreAttribute(){
		return $this->attributes['categoria'].' -> '.$this->attributes['nombre'];
	}
}