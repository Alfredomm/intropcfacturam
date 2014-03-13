<?php

class PostalcodigosController extends BaseController {

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
		$postalcodigos = Postalcodigo::paginate(20);
        return View::make('postalcodigos.index', array('postalcodigos' => $postalcodigos, 'active' => 'postalcodigos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $provincias = array('0' => '-------') + Postalcodigo::lists('provincia', 'provincia');

        return View::make('postalcodigos.create', array('provincias' => $provincias, 'active' => 'postalcodigos'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$provL = Input::get('provincias_lista');
		$validation = array();
		if( $provL == '0' ) {
			$provL = Input::get('provincia');
			$validation = Postalcodigo::validate(array(
				'codigo_postal' => Input::get('codigo_postal'),
				'poblacion' => Input::get('poblacion'),
				'provincia' => $provL
			));
		} else {
			$validation = Postalcodigo::validateNewPoblacion(array(
				'codigo_postal' => Input::get('codigo_postal'),
				'poblacion' => Input::get('poblacion')
			));
		}
		if( $validation->passes() ) {
			$poblL = Postalcodigo::create(array(
				'poblacion' => Input::get('poblacion'),
				'provincia' => $provL,
				'codigo_postal' => Input::get('codigo_postal')
			));
			return Redirect::route('postalcodigos.index');
		} else {
			return Redirect::route('postalcodigos.create')
					->withErrors($validation)
					->withInput();
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
		$postalcodigo = Postalcodigo::find($id);
        return View::make('postalcodigos.show', array('postalcodigo' => $postalcodigo, 'active' => 'postalcodigos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$postalcodigo = Postalcodigo::find($id);
        return View::make('postalcodigos.edit', array('postalcodigo' => $postalcodigo, 'active' => 'postalcodigos'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Postalcodigo::validateUpdate(Input::all());

		if( $validation->passes() ) {

			$postalcodigo = Postalcodigo::find(Input::get('id'));

			$postalcodigo->codigo_postal = Input::get('codigo_postal');
			$postalcodigo->provincia = Input::get('provincia');
			$postalcodigo->poblacion = Input::get('poblacion');

			$postalcodigo->save();

			return Redirect::to(Input::get('prevUrl'));
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
		$postalcodigo = Postalcodigo::find(Input::get('id'));
		if( count($postalcodigo->empleados) != 0 || count($postalcodigo->clientes) != 0 || count($postalcodigo->empresas) != 0 ) {
			$mensaje = 'No se puede borrar la población <strong>'.$postalcodigo->poblacion.'</strong> porque hay clientes, empleados o entidades asignados a ella.';
        	return Redirect::back()->withErrors($mensaje);
		}
		$postalcodigo->delete();
		return Redirect::to(URL::previous());
	}

	public function filter()
	{
		$busq = Input::get('nombre');
		$postalcodigos = Postalcodigo::where('nombre', 'LIKE', '%'.$busq.'%')->paginate(20);
		return View::make('postalcodigos.index', array('postalcodigos' => $postalcodigos, 'active' => 'postalcodigos'));
	}


}
