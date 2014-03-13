<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('usuarios.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('usuarios.create');
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
        return View::make('usuarios.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('usuarios.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function login()
	{
		$user = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if(Input::get('remember') == 1){
			if(Auth::attempt($user, true)){
				return Redirect::route('facturas.tipodoc', 'facturas');
			} else {
				return Redirect::intended('login');
			}
		} else {
			if(Auth::attempt($user)){
				return Redirect::route('facturas.tipodoc', 'facturas');
			} else {
				return Redirect::intended('login');
			}
		}
		
	}

	public function logout(){
		if(Auth::check()){
			Auth::logout();
			return Redirect::intended('login');
		} else {
			return Redirect::intended('login');
		}
	}

}
