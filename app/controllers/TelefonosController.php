<?php

class TelefonosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('telefonos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('telefonos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('telefonos.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$telefono = Telefono::find($id);
		return View::make('telefonos.edit', array(
	       	'telefono' => $telefono,
	       	'active' => ''
	    ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//1. Recuperar dades
		$telefono = Telefono::find(Input::get('id'));

		//2. Asignar noves dades
		$telefono->nombre = Input::get('nombre');
		$telefono->telefono = Input::get('telefono');

		//3. Guardar nou telefon
		$telefono->save();

		return Redirect::to(Input::get('prevUrl'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$telefono = Telefono::find(Input::get('id'));
		$telefono->delete();
		return Redirect::to(URL::previous());
	}

}
