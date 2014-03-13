<?php

class EmpleadosController extends BaseController {

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
		$empleados = Empleado::orderBy('nombre', 'asc')->paginate(20);
        return View::make('empleados.index', array( 'empleados' => $empleados, 'active' => 'empleados'));
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
		$tipos = array('0' => '-------') + Tipo::lists('descripcion', 'id');
		$permisos = array('0' => '-------') + Permisos::lists('descripcion', 'id');
        return View::make('empleados.create', array(
        	'postalcodigos' => $postalcodigos,
        	'provincias' => $provincias,
        	'tipos' => $tipos,
        	'permisos' => $permisos,
        	'active' => 'empleados'
        ));
	}

	/**
	 * Show the form for creating a new contact (phone, email and/or fax).
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function contacts($id)
	{
		$empleado = Empleado::find($id);
		return View::make('empleados.contacts', array('empleado' => $empleado, 'active' => 'empleados'));
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
			case 'empleado':
				$validation = Empleado::validate(Input::all());

				if( $validation->passes() ) {
					$tipoL = Input::get('tipos_lista');
					$permL = Input::get('permisos_lista');
					$poblL = Input::get('poblaciones_lista');
					if( $tipoL == '0' ) {
						$validation = Tipo::validate(Input::all());
						if( $validation->passes() ) {
							$tipoL = Tipo::create(array(
								'descripcion' => Input::get('tipo')
							))->id;
						} else {
							return Redirect::route('empleados.create')
									->withErrors($validation)
									->withInput();
						}
					}
					if( $permL == '0' ) {
						$validation = Permisos::validate(Input::all());
						if( $validation->passes() ) {
							$permL = Permisos::create(array(
								'descripcion' => Input::get('permisos')
							))->id;
						} else {
							return Redirect::route('empleados.create')
									->withErrors($validation)
									->withInput();
						}
					}
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
							return Redirect::route('empleados.create')
									->withErrors($validation)
									->withInput();
						}
					}
				
					$empleado = Empleado::create(array(
						'nombre' => Input::get('nombre'),
						'apellido1' => Input::get('apellido1'),
						'apellido2' => Input::get('apellido2'),
						'direccion' => Input::get('direccion'),
						'dni' => Input::get('dni'),
						'cuenta_corriente' => Input::get('cuenta_corriente'),
						'postalcodigo_id' => $poblL,
						'tipo' => $tipoL,
						'permisos' => $permL
					));

					return Redirect::route('empleados.contacts', $empleado->id);
				} else {
					return Redirect::route('empleados.create')
							->withErrors($validation)
							->withInput();
				}
				break;
			case 'telefono':
				$tlf = Telefono::create(array(
					'nombre' => Input::get('nombreTlf'),
					'telefono' => Input::get('telefono')
				))->id;

				$empleado = Empleado::find(Input::get('id'));

				$empleado->telefonos()->attach($tlf);

				return Redirect::route('empleados.contacts', $empleado->id);
						//->withInput(Input::except('nombreTlf', 'telefono'));
						//->withInput();
				break;
			case 'email':
				$email = Email::create(array(
					'nombre' => Input::get('nombreEmail'),
					'email' => Input::get('email')
				))->id;

				$empleado = Empleado::find(Input::get('id'));

				$empleado->emails()->attach($email);

				return Redirect::route('empleados.contacts', $empleado->id);
				break;
			case 'fax':
				$fax = Fax::create(array(
					'nombre' => Input::get('nombreFax'),
					'fax' => Input::get('fax')
				));

				$empleado = Empleado::find(Input::get('id'));

				$empleado->faxs()->attach($fax);

				return Redirect::route('empleados.contacts', $empleado->id);
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
		$empleado = Empleado::find($id);
        return View::make('empleados.show', array('empleado' => $empleado, 'active' => 'empleados'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$empleado = Empleado::find($id);
        return View::make('empleados.edit', array('empleado' => $empleado, 'active' => 'empleados'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$empleado = Empleado::find(Input::get('id'));

		$empleado->nombre = Input::get('nombre');
		$empleado->apellido1 = Input::get('apellido1');
		$empleado->apellido2 = Input::get('apellido2');
		$empleado->dni = Input::get('dni_cif');
		$empleado->direccion = Input::get('direccion');

		$empleado->save();

		return Redirect::route('empleados.show', $empleado->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$empleado = Empleado::find(Input::get('id'));
		$empleado->delete();
		return Redirect::route('empleados.index');
	}

	public function filter()
	{
		$busq = Input::get('nombre');
		$empleados = Empleado::orderBy('nombre', 'asc')->where('nombre', 'LIKE', '%'.$busq.'%')->paginate(20);
		return View::make('empleados.index', array('empleados' => $empleados, 'active' => 'empleados'));
	}

}
