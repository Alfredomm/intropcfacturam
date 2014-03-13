<?php

class MaterialesController extends BaseController {

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
        $materiales = Material::orderBy('nombre', 'asc')->paginate(20);
        return View::make('materiales.index', array('materiales' => $materiales, 'active' => 'materiales'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias_lista = array('0' => '-------') + Material::lists('categoria', 'categoria');
        return View::make('materiales.create', array('active' => 'materiales', 'categorias_lista' => $categorias_lista));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if( Input::get('categorias_lista') != '0' ) {
			$categoria = Input::get('categorias_lista');
			$validation = Material::validateUpdate(array(
				'nombre' => Input::get('nombre'),
				'cantidad' => Input::get('cantidad'),
				'precio_venta' => Input::get('precio_venta'),
				'precio_alquiler' => Input::get('precio_alquiler'),
				'categoria' => $categoria
			));
		} else {
			$categoria = Input::get('categoria');
			$validation = Material::validate(Input::all());
		}

		if( $validation->passes() ) {

			$material = Material::create(array(
				'nombre' => Input::get('nombre'),
				'categoria' => $categoria,
				'cantidad' => Input::get('cantidad'),
				'precio_venta' => Input::get('precio_venta'),
				'precio_alquiler' => Input::get('precio_alquiler')
			));

			return Redirect::route('materiales.index', $material->id);

		} else {

			return Redirect::route('materiales.create')
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
        $material = Material::find($id);
        return View::make('materiales.show', array('material' => $material, 'active' => 'materiales'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $material = Material::find($id);
        $categorias_lista = array('0' => '-------') + Material::lists('categoria', 'categoria');
        return View::make('materiales.edit', array('material' => $material, 'active' => 'materiales', 'categorias_lista' => $categorias_lista));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = Material::validateUpdate(Input::all());

		if( $validation->passes() ) {

			$material = Material::find(Input::get('id'));

			$material->nombre = Input::get('nombre');
			$material->categoria = Input::get('categoria');
			$material->cantidad = Input::get('cantidad');
			$material->precio_venta = Input::get('precio_venta');
			$material->precio_alquiler = Input::get('precio_alquiler');

			$material->save();

			return Redirect::route('materiales.show', $material->id);
		} else {
			return Redirect::route('materiales.edit', Input::get('id'))
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
		$material = Material::find(Input::get('id'));
		if( count($material->facturalineas) != 0 ) {
			$mensaje = 'No se puede borrar el material <strong>'.$material->nombre.'</strong> porque se esta usando en algunas facturas.';
        	return Redirect::back()->withErrors($mensaje);
		}
		$material->delete();
		return Redirect::route('materiales.index');
	}

	public function filter()
	{
		$busq = Input::get('nombre');
		$materiales = Material::orderBy('nombre', 'asc')->where('nombre', 'LIKE', '%'.$busq.'%')->paginate(20);
		return View::make('materiales.index', array('materiales' => $materiales, 'active' => 'materiales'));
	}

}
