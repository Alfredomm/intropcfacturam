<?php

class AjustesController extends BaseController {

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
		$ajustes = Ajuste::all();
        return View::make('ajustes.index', array('ajustes' => $ajustes, 'active' => 'ajustes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('ajustes.create');
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
        return View::make('ajustes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ajustes = Ajuste::find($id);
        return View::make('ajustes.edit', array('ajustes' => $ajustes, 'active'=>'ajustes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Ajuste::validateUpdate(Input::all());

		if( $validation->passes() ) {

			$ajustes = Ajuste::find(Input::get('id'));

			$ajustes->iva = Input::get('iva');

			$ajustes->save();

			return Redirect::route('ajustes.index');
		} else {
			return Redirect::route('ajustes.edit', Input::get('id'))
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
		//
	}

}
