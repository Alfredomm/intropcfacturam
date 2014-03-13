<?php

class ClientesController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
		//$this->beforeFilter('auth'', array('only' => 'create')');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clientes = Cliente::orderBy('id', 'asc')->paginate(20);
        return View::make('clientes.index', array('clientes' => $clientes, 'active' => 'clientes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$postalcodigos = array('0' => '-------') + Postalcodigo::lists('poblacion', 'id');
		$provincias = array('0' => '-------') + Postalcodigo::lists('provincia', 'provincia');

        return View::make('clientes.create', array('postalcodigos' => $postalcodigos, 'provincias' => $provincias, 'active' => 'clientes'));
	}

	/**
	 * Show the form for creating a client contacts (phone, email and/or fax).
	 *
	 * @return Response
	 */
	public function contacts($id)
	{
		$cliente = Cliente::find($id);
		return View::make('clientes.contacts', array('cliente' => $cliente, 'active' => 'clientes'));
	}

	/**
	 * Filter by user criteria
	 *
	 * @return Response
	 */
	public function filter()
	{
		$busq = Input::get('nombre');
		$clientes = Cliente::orderBy('nombre', 'asc')->where('nombre', 'LIKE', '%'.$busq.'%')->paginate(20);
		return View::make('clientes.index', array('clientes' => $clientes, 'active' => 'clientes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		switch(Input::get('contacto')) 
		{
			case 'cliente':
				$validation = Cliente::validate(Input::all());

				if( $validation->passes() ) {
					$poblL = Input::get('poblaciones_lista');
					if( $poblL == '0' ) {
						$poblL = Input::get('poblacion');
						$provL = Input::get('provincias_lista');
						if( $provL == '0' ) {
							$provL = Input::get('provincia');
							$validation = Postalcodigo::validate(array(
								'codigo_postal' => Input::get('codigo_postal'),
								'poblacion' => $poblL,
								'provincia' => $provL
							));
						} else {
							$validation = Postalcodigo::validateNewPoblacion(array(
								'codigo_postal' => Input::get('codigo_postal'),
								'poblacion' => $poblL
							));
						}
						if( $validation->passes() ) {
							$poblL = Postalcodigo::create(array(
								'poblacion' => $poblL,
								'provincia' => $provL,
								'codigo_postal' => Input::get('codigo_postal')
							))->id;
						} else {
							return Redirect::route('clientes.create')
									->withErrors($validation)
									->withInput();
						}
					}
				
					$cliente = Cliente::create(array(
						'nombre' => Input::get('nombre'),
						'apellido1' => Input::get('apellido1'),
						'apellido2' => Input::get('apellido2'),
						'dni_cif' => Input::get('dni_cif'),
						'direccion' => Input::get('direccion'),
						'postalcodigo_id' => $poblL,
						'sitio_web' => Input::get('sitio_web')
					));

					return Redirect::route('clientes.contacts', $cliente->id);
				} else {
					return Redirect::route('clientes.create')
						->withErrors($validation)
						->withInput();
				}
				break;
			case 'telefono':
				$validation = Telefono::validate(Input::all());
				$cliente = Cliente::find(Input::get('id'));
				if( $validation->passes() ){
					$tlf = Telefono::create(array(
					'nombre' => Input::get('nombreTlf'),
					'telefono' => Input::get('telefono')
					))->id;

					$cliente->telefonos()->attach($tlf);

					return Redirect::route('clientes.contacts', $cliente->id);
				} else {
					return Redirect::route('clientes.contacts', $cliente->id)
							->withErrors($validation)
							->withInput();
				}
				break;
			case 'email':
				$validation = Email::validate(Input::all());
				$cliente = Cliente::find(Input::get('id'));
				if( $validation->passes() ){
					$email = Email::create(array(
						'nombre' => Input::get('nombreEmail'),
						'email' => Input::get('email')
					))->id;

					$cliente->emails()->attach($email);

					return Redirect::route('clientes.contacts', $cliente->id);
				} else {
					return Redirect::route('clientes.contacts', $cliente->id)
							->withErrors($validation)
							->withInput();
				}
				break;
			case 'fax':
				$validation = Fax::validate(Input::all());
				$cliente = Cliente::find(Input::get('id'));
				if( $validation->passes() ){
					$fax = Fax::create(array(
						'nombre' => Input::get('nombreFax'),
						'fax' => Input::get('fax')
					));

					$cliente = Cliente::find(Input::get('id'));

					$cliente->faxs()->attach($fax);

					return Redirect::route('clientes.contacts', $cliente->id);
				} else {
					return Redirect::route('clientes.contacts', $cliente->id)
							->withErrors($validation)
							->withInput();
				}
				break;
			default:
				break;
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cliente = Cliente::find($id);
        return View::make('clientes.show', array('cliente' => $cliente, 'active' => 'clientes'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cliente = Cliente::find($id);
		$postalcodigos = array('0' => '-------') + Postalcodigo::lists('poblacion', 'id');
        return View::make('clientes.edit', array('cliente' => $cliente, 'postalcodigos' => $postalcodigos, 'active' => 'clientes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Cliente::validateUpdate(Input::all());

		if( $validation->passes() ) {
			$cliente = Cliente::find(Input::get('id'));

			$cliente->nombre = Input::get('nombre');
			$cliente->apellido1 = Input::get('apellido1');
			$cliente->apellido2 = Input::get('apellido2');
			$cliente->dni_cif = Input::get('dni_cif');
			$cliente->direccion = Input::get('direccion');
			$cliente->sitio_web = Input::get('sitio_web');
			$cliente->postalcodigo_id = Input::get('postalcodigo_id');

			$cliente->save();

			return Redirect::route('clientes.show', $cliente->id);
		} else {
			return Redirect::route('clientes.edit', Input::get('id'))
					->withErrors($validation)
					->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cliente = Cliente::find(Input::get('id'));
		if( count($cliente->facturas) != 0 ) {
        	$mensaje = 'No se puede borrar el cliente <strong>'.$cliente->nombre.'</strong> porque hay facturas a su nombre.';
        	return Redirect::back()->withErrors($mensaje);
        }
		$cliente->delete();
		return Redirect::route('clientes.index');
	}
}
