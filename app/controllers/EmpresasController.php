<?php

class EmpresasController extends BaseController {

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
		$empresas = Empresa::all();
        return View::make('empresas.index', array('empresas' => $empresas, 'active' => 'empresas'));
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
        return View::make('empresas.create', array('active' => 'empresas', 'postalcodigos' => $postalcodigos, 'provincias' => $provincias));
	}

	/**
	 * Show the form for creating a empresa contacts (phone, email and/or fax).
	 *
	 * @return Response
	 */
	public function contacts($id)
	{
		$empresa = Empresa::find($id);
		return View::make('empresas.contacts', array('empresa' => $empresa, 'active' => 'empresas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		switch (Input::get('contacto')) {
			case 'empresa':
					
				$validation = Empresa::validate(Input::all());

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
							return Redirect::route('empresas.create')
									->withErrors($validation)
									->withInput();
						}
					}
				
					$empresa = Empresa::create(array(
						'nombre' => Input::get('nombre'),
						'cif' => Input::get('cif'),
						'direccion' => Input::get('direccion'),
						'sitio_web' => Input::get('sitio_web'),
						'cuenta_corriente' => Input::get('cuenta_corriente'),
						'postalcodigo_id' => $poblL
					));

					return Redirect::route('empresas.contacts', $empresa->id);
				} else {
					return Redirect::route('empresas.create')
						->withErrors($validation)
						->withInput();
				}

				break;

			case 'telefono':
				$validation = Telefono::validate(Input::all());
				$empresa = Empresa::find(Input::get('id'));
				if( $validation->passes() ){
					$tlf = Telefono::create(array(
					'nombre' => Input::get('nombreTlf'),
					'telefono' => Input::get('telefono')
					))->id;

					$empresa->telefonos()->attach($tlf);

					return Redirect::route('empresas.contacts', $empresa->id);
				} else {
					return Redirect::route('empresas.contacts', $empresa->id)
							->withErrors($validation)
							->withInput();
				}
				break;

			case 'fax':

				$validation = Fax::validate(Input::all());
				$empresa = Empresa::find(Input::get('id'));
				if( $validation->passes() ){
					$fax = Fax::create(array(
						'nombre' => Input::get('nombreFax'),
						'fax' => Input::get('fax')
					));

					$empresa = empresa::find(Input::get('id'));

					$empresa->faxs()->attach($fax);

					return Redirect::route('empresas.contacts', $empresa->id);
				} else {
					return Redirect::route('empresas.contacts', $empresa->id)
							->withErrors($validation)
							->withInput();
				}

				break;

			case 'email':

				$validation = Email::validate(Input::all());
				$empresa = Empresa::find(Input::get('id'));
				if( $validation->passes() ){
					$email = Email::create(array(
						'nombre' => Input::get('nombreEmail'),
						'email' => Input::get('email')
					))->id;

					$empresa->emails()->attach($email);

					return Redirect::route('empresas.contacts', $empresa->id);
				} else {
					return Redirect::route('empresas.contacts', $empresa->id)
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
		$empresa = Empresa::find($id);
        return View::make('empresas.show', array('empresa' => $empresa, 'active' => 'empresas'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$empresa = Empresa::find($id);
		$postalcodigos = array('0' => '-------') + Postalcodigo::lists('poblacion', 'id');
        return View::make('empresas.edit', array('empresa' => $empresa, 'active' => 'empresas', 'postalcodigo_id'=> $postalcodigos));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$empresa = Empresa::find(Input::get('id'));

		$empresa->nombre = Input::get('nombre');
		$empresa->direccion = Input::get('direccion');
		$empresa->cif = Input::get('cif');
		$empresa->postalcodigo_id = Input::get('postalcodigo_id');
		$empresa->sitio_web = Input::get('sitio_web');
		$empresa->cuenta_corriente = Input::get('cuenta_corriente');

		$empresa->save();

		return Redirect::route('empresas.show', $empresa->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$empresa = Empresa::find(Input::get('id'));
		$empresa->delete();
		return Redirect::route('empresas.index');
	}

}
