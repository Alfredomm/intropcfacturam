<?php

class FaxsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('faxs.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('faxs.create');
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
        return View::make('faxs.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $fax = Fax::find($id);
        return View::make('faxs.edit', array(
        	'fax' => $fax,
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
		$fax = Fax::find(Input::get('id'));

		//2. Asignar noves dades
		$fax->nombre = Input::get('nombre');
		$fax->fax = Input::get('fax');

		//3. Guardar nou telefon
		$fax->save();

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
		$fax = Fax::find(Input::get('id'));
		$fax->delete();
		return Redirect::to(URL::previous());
	}

}
