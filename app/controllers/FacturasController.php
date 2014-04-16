<?php

class FacturasController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
		//$this->beforeFilter('auth'', array('only' => 'create')');
	}

	public function tipodoc($tipo){
		$meses = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);

		$anyos = array();
		$anyos[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyos[$i] = $i;
		}

		$ajustes = Tiposiva::all()->first();

		$facturasrectificativa = "";

		switch ($tipo) {
			case 'facturas':
					$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->paginate(20);

					$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->paginate(20);

					$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->paginate(20);
				break;
			
			case 'presupuestos':
					$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->paginate(20);

					$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->paginate(20);
				break;

			case 'borradores':
					$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->paginate(20);

					$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->paginate(20);
				break;
		}
        return View::make('facturas.index', array(
        	'meses' => $meses,
        	'anyos' => $anyos,
        	'facturasventa' => $facturasventa,
        	'facturasalquiler' => $facturasalquiler,
        	'facturasrectificativa' => $facturasrectificativa,
        	'tipo' => $tipo,
        	'active' => $tipo,
        	'iva' => $ajustes->iva
        ));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$meses = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);

		$anyos = array();
		$anyos[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyos[$i] = $i;
		}

		$facturas = Factura::orderBy('fecha', 'desc')->paginate(20);
        return View::make('facturas.index', array(
        	'meses' => $meses,
        	'anyos' => $anyos,
        	'facturas' => $facturas,
        	'active' => 'facturas'
        	));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createtipo($tipo){
		$cliente = array('0' => '-------') + Cliente::lists('nombre', 'id');
		
        return View::make('facturas.create', array('cliente' => $cliente, 'tipo' => $tipo, 'active' => $tipo));
	}

	public function create()
	{
		$cliente = array('0' => '-------') + Cliente::lists('nombre', 'id');
		
        return View::make('facturas.create', array('cliente' => $cliente, 'active' => 'facturas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if( Input::has('factura_id') ) {
			$factura = Factura::find(Input::get('factura_id'));
			$facturalineas = Facturalinea::where('factura_id', '=', Input::get('factura_id'))->orderBy('posicion')->get();
		} else {
			$factura = Factura::find($id);
			$facturalineas = Facturalinea::where('factura_id', '=', $id)->orderBy('posicion')->get();
		}

		$empresas = Empresa::orderBy('id', 'asc')->take(2)->get();
		if( count($empresas) < 1 ) {
			$mensaje = 'Añade los datos de tu empresa antes de crear una factura';
        	return Redirect::back()->withErrors($mensaje);
		} else if( count($empresas) == 1 ) {
			$empresa = $empresas[0];
			$empresa2 = null;
		} else {
			$empresa2 = $empresas[1];
		}

		$prevUrl = URL::previous();

		$calcularTotal = strpos($prevUrl, 'createlineshow');
		if( $calcularTotal != false ) {
			if( Input::get('direccion2') == 1 ) {
				$factura->direccion2 = 1;
			} else {
				$factura->direccion2 = 0;
			}
			$factura->observaciones = Input::get('observaciones');
			$factura->save();
		}

		$pdf = PDF::loadView('facturas.show', array('factura' => $factura, 'facturalineas' => $facturalineas, 'empresa' => $empresa, 'empresa2' => $empresa2));
		return $pdf->setPaper('a4')->setOrientation('portrait')->stream();
        //return View::make('facturas.show', array('factura' => $factura, 'empresa' => $empresa));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('facturas.edit', array('active' => 'facturas'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$factura = Factura::find(Input::get('id'));
		$fecha = Input::get('anyo').''.Input::get('mes').''.Input::get('dia');
		
		if( Input::get('update') == 'fecha_emision' ) {
			$factura->fecha = $fecha;
		} else if( Input::get('update') == 'borrar_fecha_pagado' ) {
			$factura->fecha_pagado = '';
		} else if( Input::get('update') == 'cliente' ) {
			$factura->cliente_id = Input::get('nombreCli_id');
		} else {			
			$factura->fecha_pagado = $fecha;
		}
		$factura->save();

		return Redirect::route('facturas.createlineshow', array( Input::get('tipo'), $factura->id ));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tipo = Input::get('tipo');

		if( $tipo == 'borradores' ){

			$factura = Factura::find(Input::get('id'));
			$factura->delete();
			return Redirect::route('facturas.tipodoc', $tipo);
		}
		
	}

	public function verification()
	{
		$tipo = Input::get('tipo');

		$tipologia = Input::get('tipologia');

		if( Input::get('nombre') == '0' && ( Input::get('nombreCli_id') == '{{asyncSelected.id}}' || Input::get('nombreCli_id') == '' ) ){

			return Redirect::route('facturas.createtipo', array('tipo' => $tipo, 'error' => 'Debes seleccionar un cliente para continuar'));

		} 

		if( $tipologia == '' ){

			return Redirect::route('facturas.createtipo', array('tipo' => $tipo, 'error' => 'Debes seleccionar un tipo de documento para continuar'));

		} else {
			if( Input::get('nombreCli_id') != '{{asyncSelected.id}}' ) {
				return Redirect::route('facturas.verificationshow', array($tipo, $tipologia, Input::get('nombreCli_id')));
			} else {
				return Redirect::route('facturas.verificationshow', array($tipo, $tipologia, Input::get('nombre')));
			}			
		}
	}

	public function verificationshow($tipo, $tipologia, $id)
	{
		$cliente = Cliente::find($id);

		$dias = array();
		for ($i=0; $i < 31; $i++) {
			if( $i < 9 ) {
				$dias['0'.($i+1)] = '0'.($i+1);
			} else {
				$dias[$i+1] = $i+1;
			}
		}
		$meses = array(
			'01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);
		$anyos = array();
		for ($i=1940; $i < date('o')+1; $i++) { 
			$anyos[$i] = $i;
		}
		return View::make('facturas.verification', array(
			'cliente' => $cliente,
			'active' => $tipo,
			'dias' => $dias,
			'meses' => $meses,
			'anyos' => $anyos,
			'tipo' => $tipo,
			'tipologia' => $tipologia
		));
	}

	public function createline()
	{
		$fecha = Input::get('anyo').''.Input::get('mes').''.Input::get('dia');
		$tipo = Input::get('tipo');
		$tipologia = Input::get('tipologia');

		if( $tipo == 'facturas' ){
			if( $tipologia == 'venta' ){

				$ultimaFactura = Factura::where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('venta', '=', '1')->orderBy('id', 'desc')->first();
				
				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}
				
				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'venta' => 1,
					'num_factura' => $num_factura + 1
				))->id;

			} else {

				$ultimaFactura = Factura::where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('venta', '=', '0')->orderBy('id', 'desc')->first();

				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}

				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'venta' => 0,
					'num_factura' => $num_factura + 1
				))->id;

			}

		}

		if( $tipo == 'presupuestos' ){
			if( $tipologia == 'venta' ){

				$ultimaFactura = Factura::where('presupuesto', '=', '1')->where('venta', '=', '1')->orderBy('id', 'desc')->first();

				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}

				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'presupuesto' => 1,
					'venta' => 1,
					'num_factura' => $num_factura + 1
				))->id;

			} else {

				$ultimaFactura = Factura::where('presupuesto', '=', '1')->where('venta', '=', '0')->orderBy('id', 'desc')->first();

				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}

				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'presupuesto' => 1,
					'venta' => 0,
					'num_factura' => $num_factura + 1
				))->id;

			}

		}

		if( $tipo == 'borradores' ){
			if( $tipologia == 'venta' ){

				$ultimaFactura = Factura::where('borrador', '=', '1')->where('venta', '=', '1')->orderBy('id', 'desc')->first();

				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}

				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'borrador' => 1,
					'venta' => 1,
					'num_factura' => $num_factura + 1
				))->id;

			} else {

				$ultimaFactura = Factura::where('borrador', '=', '1')->where('venta', '=', '0')->orderBy('id', 'desc')->first();

				if( $ultimaFactura != NULL && Input::get('anyo') == substr($ultimaFactura->fecha, 0, 4) ) {
					$num_factura = $ultimaFactura->num_factura;	
				} else {
					$num_factura = 0;
				}

				$factura = Factura::create(array(

					'cliente_id' => Input::get('cliente_id'),
					'fecha' => $fecha,
					'borrador' => 1,
					'venta' => 0,
					'num_factura' => $num_factura + 1
				))->id;

			}

		}

		return Redirect::route('facturas.createlineshow', array($tipo, $factura));
	}

	public function createlineshow($tipo, $id, $mat = "")
	{
		$materiales = Material::all();
		$materiales->lists('categoriaNombre', 'id');
		$material = array('0' => '-------') + $materiales->lists('categoriaNombre', 'id');
		$factura = Factura::find($id);
		$tipoiva = Tiposiva::lists('iva', 'iva');
		$facturalineas = Facturalinea::where('factura_id', '=', $id)->orderBy('posicion', 'desc')->get();

		$dias = array();
		for ($i=0; $i < 31; $i++) {
			if( $i < 9 ) {
				$dias['0'.($i+1)] = '0'.($i+1);
			} else {
				$dias[$i+1] = $i+1;
			}
		}
		$meses = array(
			'01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);
		$anyos = array();
		for ($i=1940; $i < date('o')+1; $i++) { 
			$anyos[$i] = $i;
		}

		if( $mat == "" ) {
			return View::make('facturas.createline', array( 'tipo' => $tipo, 'material' => $material, 'active' => $tipo, 'factura' => $factura, 'facturalineas' => $facturalineas, 'dias' => $dias, 'meses' => $meses, 'anyos' => $anyos, 'tipoiva' => $tipoiva ));
		} else {
			$mat = Material::find($mat);
			return View::make('facturas.createline', array( 'tipo' => $tipo, 'material' => $material, 'mat' => $mat, 'active' => $tipo, 'factura' => $factura, 'facturalineas' => $facturalineas, 'dias' => $dias, 'meses' => $meses, 'anyos' => $anyos, 'tipoiva' => $tipoiva ));
		}
	}

	public function refreshmaterial()
	{	
		if( Input::get('nombreMat_id') != '{{asyncSelected.id}}' && Input::get('nombreMat_id') != '' ) {
			return Redirect::route('facturas.createlineshow', array(Input::get('tipo'), Input::get('factura_id'), Input::get('nombreMat_id')));
		} else if((Input::has('nombre'))&&(Input::get('nombre')!="0")) { // S'ha sel·leccionat un material de la llista, actualitzem la pagina amb el material carregat al formulari
			return Redirect::route('facturas.createlineshow', array(Input::get('tipo'), Input::get('factura_id'), Input::get('nombre')));
		} else {
			return Redirect::route('facturas.createlineshow', array(Input::get('tipo'), Input::get('factura_id')));
		}

	}

	public function addline()
	{
		$validation = Facturalinea::validate(Input::all());
		if( $validation->passes() ) {
			if( Input::has('precio_venta') ) {
				$precio = Input::get('precio_venta');
			} else {
				$precio = Input::get('precio_alquiler');
			}

			if( $precio == NULL ) {
				$precio = 0;
			}

			$subtotal = ((Input::get('cantidad_material'))*($precio)*(Input::get('dias')))-((Input::get('cantidad_material'))*($precio)*(Input::get('dias'))*(Input::get('descuento')/100));

			$subtotal = $subtotal + ($subtotal*(Input::get('iva')/100));

			$material = Material::find(Input::get('material_id'));
			if( Input::has('material_id') && $material->nombre == Input::get('nombre') ) {
				$facturalinea = Facturalinea::create(array(
					'material_id' => Input::get('material_id'),
					'factura_id' => Input::get('factura_id'),
					'cantidad_material' => Input::get('cantidad_material'),
					'precio' => $precio,
					'dias' => Input::get('dias'),
					'iva' => Input::get('iva'),
					'descuento' => Input::get('descuento'),
					'subtotal' => $subtotal
				));
			}

			else {
				$facturalinea = Facturalinea::create(array(
					'nombre' => Input::get('nombre'),
					'factura_id' => Input::get('factura_id'),
					'cantidad_material' => Input::get('cantidad_material'),
					'precio' => $precio,
					'dias' => Input::get('dias'),
					'iva' => Input::get('iva'),
					'descuento' => Input::get('descuento'),
					'subtotal' => $subtotal
				));
			}

			$factura = Factura::find(Input::get('factura_id'));
			$total = 0;
			foreach ($factura->facturalineas as $fl) {
				$total += $fl->subtotal;
			}
			$factura->total = $total;
			$factura->save();

			return Redirect::route('facturas.createlineshow', array( Input::get('tipo'), Input::get('factura_id') ));

		} else {

			return Redirect::route('facturas.createlineshow', array( Input::get('tipo'), Input::get('factura_id') ))
				->withErrors($validation)
				->withInput();

		}
	}

	public function convert($id)
	{
		$presupuesto = Factura::find($id);
		if( $presupuesto->venta == 1 ) {

			$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '0')->where('venta', '=', '1')->orderBy('id', 'desc')->first();

			if( $ultimaFactura != NULL && substr($presupuesto->fecha, 0, 4) == substr($ultimaFactura->fecha, 0, 4) ) {
				$num_factura = $ultimaFactura->num_factura;	
			} else {
				$num_factura = 0;
			}

		} else {
			$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '0')->where('venta', '=', '0')->orderBy('id', 'desc')->first();

			if( $ultimaFactura != NULL && substr($presupuesto->fecha, 0, 4) == substr($ultimaFactura->fecha, 0, 4) ) {
				$num_factura = $ultimaFactura->num_factura;	
			} else {
				$num_factura = 0;
			}
		}

		$factura = Factura::create(array(
			'cliente_id' => $presupuesto->cliente_id,
			'fecha' => $presupuesto->fecha,
			'total' => $presupuesto->total,
			'presupuesto' => 0,
			'borrador' => 0,
			'venta' => $presupuesto->venta,
			'num_factura' => $num_factura + 1
		))->id;

		foreach ($presupuesto->facturalineas as $pfl) {
			Facturalinea::create(array(
				'nombre' => $pfl->nombre,
				'factura_id' => $factura,
				'cantidad_material' => $pfl->cantidad_material,
				'precio' => $pfl->precio,
				'dias' => $pfl->dias,
				'descuento' => $pfl->descuento,
				'subtotal' => $pfl->subtotal
			));
		}

		return Redirect::route('facturas.createlineshow', array('facturas', $factura));
	}

	public function duplicate($id, $tipo)
	{
		$factura = Factura::find($id);
		if( $factura->venta == 1 ) {
			if( $tipo == 'facturas' ){
				$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '0')->where('venta', '=', '1')->orderBy('id', 'desc')->first();
			} else {
				$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '1')->where('venta', '=', '1')->orderBy('id', 'desc')->first();
			}
		} else {
			if( $tipo == 'facturas' ){
				$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '0')->where('venta', '=', '0')->orderBy('id', 'desc')->first();
			} else {
				$ultimaFactura = Factura::where('borrador', '=', '0')->where('presupuesto', '=', '1')->where('venta', '=', '0')->orderBy('id', 'desc')->first();
			}
		}

		if( $ultimaFactura != NULL && date('o') == substr($ultimaFactura->fecha, 0, 4) ) {
			$num_factura = $ultimaFactura->num_factura;	
		} else {
			$num_factura = 0;
		}

		$fecha = date('o').''.date('m').''.date('d');

		if( $tipo == 'facturas' ) {
			$facturaNueva = Factura::create(array(
				'cliente_id' => $factura->cliente_id,
				'fecha' => $fecha,
				'total' => $factura->total,
				'presupuesto' => 0,
				'borrador' => 0,
				'venta' => $factura->venta,
				'num_factura' => $num_factura + 1
			))->id;
		} else {
			$facturaNueva = Factura::create(array(
				'cliente_id' => $factura->cliente_id,
				'fecha' => $fecha,
				'total' => $factura->total,
				'presupuesto' => 1,
				'borrador' => 0,
				'venta' => $factura->venta,
				'num_factura' => $num_factura + 1
			))->id;
		}

		foreach ($factura->facturalineas as $fl) {
			Facturalinea::create(array(
				'nombre' => $fl->nombre,
				'factura_id' => $facturaNueva,
				'cantidad_material' => $fl->cantidad_material,
				'precio' => $fl->precio,
				'dias' => $fl->dias,
				'descuento' => $fl->descuento,
				'subtotal' => $fl->subtotal
			));
		}

		if( $tipo == 'facturas' ) {
			return Redirect::route('facturas.createlineshow', array('facturas', $facturaNueva));
		} else {
			return Redirect::route('facturas.createlineshow', array('presupuestos', $facturaNueva));
		}
	}

	public function convertRectificativa($id) {
		$facturaOriginal = Factura::find($id);
		$facturaOriginal->existe_rectificativa = 1;
		$facturaOriginal->save();

		$ultimaFactura = Factura::where('rectificativa', '=', '1')->orderBy('id', 'desc')->first();

		if( $ultimaFactura != NULL && substr($facturaOriginal->fecha, 0, 4) == substr($ultimaFactura->fecha, 0, 4) ) {
			$num_factura = $ultimaFactura->num_factura;	
		} else {
			$num_factura = 0;
		}

		$factura = Factura::create(array(
			'cliente_id' => $facturaOriginal->cliente_id,
			'fecha' => $facturaOriginal->fecha,
			'total' => $facturaOriginal->total,
			'presupuesto' => 0,
			'borrador' => 0,
			'venta' => $facturaOriginal->venta,
			'rectificativa' => 1,
			'num_factura' => $num_factura + 1
		))->id;

		foreach ($facturaOriginal->facturalineas as $fl) {
			Facturalinea::create(array(
				'nombre' => $fl->nombre,
				'factura_id' => $factura,
				'cantidad_material' => $fl->cantidad_material,
				'precio' => $fl->precio,
				'dias' => $fl->dias,
				'descuento' => $fl->descuento,
				'subtotal' => $fl->subtotal
			));
		}

		return Redirect::route('facturas.createlineshow', array('facturas', $factura));

	}

	public function search()
	{

		$nombre = Input::get('clientes');
		$mes = Input::get('mes');
		$anyo = Input::get('anyo');
		$tipo = Input::get('tipo');
		$ajustes = Tiposiva::first();
		
		$meses = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);

		$anyos = array();
		$anyos[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyos[$i] = $i;
		}

        $facturasrectificativa = '';

        switch ($tipo) {
			case 'facturas':
					if( $mes == "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes == "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					}
				break;
			
			case 'presupuestos':
					if( $mes == "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes == "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					}
				break;

			case 'borradores':
					if( $mes == "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo == "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->where('fecha', 'LIKE', '____'.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes == "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->where('fecha', 'LIKE', $anyo.'____')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					} else if ( $mes != "0" && $anyo != "0" ) {
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->where('fecha', 'LIKE', $anyo.''.$mes.'__')->whereIn('cliente_id', function($query) use ($nombre)
						{
							$query->select(DB::raw('id'))
								  ->from('clientes')
								  ->whereRaw("nombre LIKE '%$nombre%'");
						})->paginate(20);
					}
				break;

			default:
					
				break;
		}

        return View::make('facturas.index', array(
        	'meses' => $meses,
        	'anyos' => $anyos,
        	'facturasventa' => $facturasventa,
        	'facturasalquiler' => $facturasalquiler,
        	'facturasrectificativa' => $facturasrectificativa,
        	'tipo' => $tipo,
        	'active' => $tipo,
        	'iva' => $ajustes->iva
        ));

	}

	public function listamateriales(){

		$materiales = Material::all();

		//$materialjs = $materiales->lists('categoriaNombre', 'id');

		$mat = array();

		foreach ($materiales as $material) {
			$m = array('id' => $material->id, 'categoria' => $material->categoria, 'nombre' => $material->nombre, 'nombreCat' => $material->categoria.' '.$material->nombre);
			array_push($mat, $m);
		}

		return Response::json( array('materialjs' => $mat) );

	}

	public function listaclientes(){

		$clientes = Cliente::all();

		//$materialjs = $clientes->lists('categoriaNombre', 'id');

		$cli = array();

		foreach ($clientes as $cliente) {
			$c = array('id' => $cliente->id, 'nombre' => $cliente->nombre, 'apellido1' => $cliente->apellido1, 'apellido2' => $cliente->apellido2, 'nombreCompleto' => $cliente->nombre.' '.$cliente->apellido1.' '.$cliente->apellido2);
			array_push($cli, $c);
		}

		return Response::json( array('clientejs' => $cli) );

	}

	public function updatePosicion($id_factura)
	{
		$lineasFactura = Facturalinea::where('factura_id', '=', $id_factura)->orderBy('posicion', 'desc')->first(); // Total lineas factura = 1
		$posicionLinea = Facturalinea::where('id', '=', Input::get('id'))->first(); // Posició de la liniea a menejar = 
		$indexNuevo = Input::get('index'); // Nou index de la linea menejada

		$nuevaPosicion = ($lineasFactura->posicion) - ( $indexNuevo ); // La nova posicio de la linea

		if( $nuevaPosicion > $posicionLinea->posicion ) {
			$lineasARestar = Facturalinea::where('factura_id', '=', $id_factura)->whereBetween('posicion', array($posicionLinea->posicion+1, $nuevaPosicion))->get();
			//$lineasARestar = Facturalinea::where('factura_id', '=', $id_factura)->where('posicion', '<=', $nuevaPosicion)->where('posicion', '>', $posicionLinea->posicion)->get();
			//return Response::json(array('lineas' => $lineasARestar));
			foreach ($lineasARestar as $lR) {
				//return Response::json(array('id_linea' => $lR->id, 'posicion' => $lR->posicion));
				$lR->posicion = $lR->posicion - 1;
				$lR->save();
			}
			$posicionLinea->posicion = $nuevaPosicion;
			$posicionLinea->save();
		} else if( $nuevaPosicion < $posicionLinea->posicion ){
			$lineasARestar = Facturalinea::where('factura_id', '=', $id_factura)->whereBetween('posicion', array($nuevaPosicion, $posicionLinea->posicion-1))->get();
			//$lineasARestar = Facturalinea::where('factura_id', '=', $id_factura)->where('posicion', '>=', $nuevaPosicion)->where('posicion', '<', $posicionLinea->posicion)->get();
			//return Response::json(array('lineas' => $lineasARestar));
			foreach ($lineasARestar as $lR) {
				//return Response::json(array('id_linea' => $lR->id, 'posicion' => $lR->posicion));
				$lR->posicion = $lR->posicion + 1;
				$lR->save();
			}
			$posicionLinea->posicion = $nuevaPosicion;
			$posicionLinea->save();
		}


		return Response::json('ok');
		//return Response::json( array('id_factura' => $id_factura, 'id' => Input::get('id'), 'index' => Input::get('index')) );
	}

	public function resumen(){

		$tipoiva = array('0' => '-------') + Tiposiva::lists('iva', 'iva');

		$mesesini = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);

		$anyosini = array();
		$anyosini[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyosini[$i] = $i;
		}

		$mesesfin = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);

		$anyosfin = array();
		$anyosfin[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyosfin[$i] = $i;
		}

		$flag = 0;

		if( Input::get('iva') != '0' ){

			$facturalinea = Facturalinea::where('iva', '=', Input::get('iva'))->get();

		} else {

			$facturalinea = Facturalinea::all();

		}

		if( (Input::get('mesesini') != '00') && (Input::get('mesesfin') != '00') && (Input::get('anyosini') != '0') && (Input::get('anyosfin') != '0') ){

			/*$facturalinea = Factura::where('fecha', '>=', Input::get('anyosini').'____')->where('fecha', '<=', Input::get('anyosfin').'____')->where('fecha', '>=', '____'.Input::get('mesesini').'__')->where('fecha', '<=', '____'.Input::get('mesesfin').'__')->get();*/

			$flag = 1;

		}

		return View::make('facturas.resumen', array('active' => 'resumen', 'flag' => $flag, 'tipoiva' => $tipoiva, 'facturalinea' => $facturalinea, 'mesesini' => $mesesini, 'mesesfin' => $mesesfin, 'anyosini' => $anyosini, 'anyosfin' => $anyosfin));

	}

	public function searchnum(){

		$tipo = Input::get('tipo');
		$meses = array(
			'00' => '-------', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
		);
		$anyos = array();
		$anyos[0] = '-------';
		for ($i=1940; $i < date('o')+1; $i++) {
			$anyos[$i] = $i;
		}

		$ajustes = Tiposiva::all()->first();

		$facturasrectificativa = "";

		if( Input::get('numerofactura') == "" ){

			switch ($tipo) {
				case 'facturas':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->paginate(20);

						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->paginate(20);
					break;
				
				case 'presupuestos':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->paginate(20);
					break;

				case 'borradores':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->paginate(20);
					break;
			}
		} else {

			$numerofactura = Input::get('numerofactura');

			switch ($tipo) {
				case 'facturas':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '1')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '0')->where('venta', '=', '0')->where('presupuesto', '=', '0')->where('borrador', '=', '0')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);

						$facturasrectificativa = Factura::orderBy('fecha', 'desc')->where('rectificativa', '=', '1')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);
					break;
				
				case 'presupuestos':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('presupuesto', '=', '1')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('presupuesto', '=', '1')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);
					break;

				case 'borradores':
						$facturasventa = Factura::orderBy('fecha', 'desc')->where('venta', '=', '1')->where('borrador', '=', '1')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);

						$facturasalquiler = Factura::orderBy('fecha', 'desc')->where('venta', '=', '0')->where('borrador', '=', '1')->where('num_factura', 'LIKE', $numerofactura)->paginate(20);
					break;
			}

		}

		return View::make('facturas.index', array('tipo' => $tipo, 'meses' => $meses, 'anyos' => $anyos, 'active' => $tipo, 'facturasventa' => $facturasventa, 'facturasalquiler' => $facturasalquiler, 'facturasrectificativa' => $facturasrectificativa, 'ajustes' => $ajustes, 'iva' => $ajustes->iva));

	}

}