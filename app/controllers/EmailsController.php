<?php

class EmailsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('emails.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('emails.create');
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
        return View::make('emails.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $email = Email::find($id);
        return View::make('emails.edit', array(
        	'email' => $email,
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
		$email = Email::find(Input::get('id'));

		//2. Asignar noves dades
		$email->nombre = Input::get('nombre');
		$email->email = Input::get('email');

		//3. Guardar nou telefon
		$email->save();

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
		$email = Email::find(Input::get('id'));
		$email->delete();
		return Redirect::to(URL::previous());
	}

}
