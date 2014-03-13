@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar cliente</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('clientes.show',$cliente->id) }}">Volver al cliente</a>
	<a class="btn btn-primary boto1" href="{{ route('clientes.contacts',$cliente->id) }}">Gestionar contactos</a>

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('dni_cif', '<li>:message</li>') }}
				{{ $errors->first('postalcodigo_id', '<li>El campo Población debe tener una población seleccionada</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		{{ Form::model($cliente, array( 'method' => 'PUT', 'route' => 'clientes.update' ) ) }}
		
			{{ Form::token() }}

			{{ Form::hidden('id', $cliente->id) }}

			<div class="col-xs-4">

				<p>
					{{ Form::label('nombre', 'Nom') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('apellido1', 'Apellidos') }}
					{{ Form::text('apellido1', Input::old('apellido1'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('apellido2', 'Segunda línea de nombre') }}
					{{ Form::text('apellido2', Input::old('apellido2'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('dni_cif', 'Dni / Cif') }}
					{{ Form::text('dni_cif', Input::old('dni'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('direccion', 'Dirección') }}
					{{ Form::text('direccion', Input::old('direccion'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('postalcodigo_id', 'Población') }}
					{{ Form::select('postalcodigo_id', $postalcodigos, Input::old('postalcodigo_id'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('sitio_web', 'Página web') }}
					{{ Form::text('sitio_web', Input::old('sitio_web'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::submit(('Guardar'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Deshacer cambios'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-xs-4 -->

		</div><!-- End row -->

	{{ Form::close() }}

@stop