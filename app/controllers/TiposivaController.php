<?php

class TiposivaController extends BaseController {

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
		$tipoiva = Tiposiva::all();
        return View::make('tiposiva.index', array('tipoiva' => $tipoiva, 'active' => 'ajustes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('tiposiva.create', array('active' => 'ajustes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Tiposiva::validate(Input::all());

		if( $validation->passes() ) {

			$tipoiva = Tiposiva::create(array(
				'tipo' => Input::get('tipo'),
				'iva' => Input::get('iva')
			));

			return Redirect::route('tiposiva.index', $tipoiva->id);

		} else {

			return Redirect::route('tiposiva.create')
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
        return View::make('tiposiva.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tipoiva = Tiposiva::find($id);
        return View::make('tiposiva.edit', array('tipoiva' => $tipoiva, 'active'=>'ajustes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tipoiva = Tiposiva::find(Input::get('id'));
		$tipoiva->delete();
		return Redirect::route('tiposiva.index');
	}

}
