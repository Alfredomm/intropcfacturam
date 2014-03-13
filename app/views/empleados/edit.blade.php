@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar client</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empleados.show',$empleado->id) }}">Volver al empleado</a>
	<a class="btn btn-primary boto1" href="{{ route('empleados.contacts',$empleado->id) }}">Gestionar contactos</a>
	<!-- {{ HTML::linkRoute('empleados.index', 'Llista de empleados') }} -->

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Hi ha hagut alguns errors:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('apellido1', '<li>:message</li>') }}
				{{ $errors->first('apellido2', '<li>:message</li>') }}
				{{ $errors->first('dni_cif', '<li>:message</li>') }}
				{{ $errors->first('direccion', '<li>:message</li>') }}
				{{ $errors->first('sitio_web', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">
		<div class="col-xs-4">
			{{ Form::model($empleado, array( 'method' => 'PUT', 'route' => 'empleados.update' ) ) }}
			
				{{ Form::token() }}

				{{ Form::hidden('id', $empleado->id) }}

					<p>
						{{ Form::label('nombre', 'Nom') }}
						{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::label('apellido1', 'Primer apellido') }}
						{{ Form::text('apellido1', Input::old('apellido1'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::label('apellido2', 'Segundo apellido') }}
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
						{{ Form::label('sitio_web', 'Página web') }}
						{{ Form::text('sitio_web', Input::old('sitio_web'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::submit(('Guardar'),array('class'=>'btn btn-primary')) }}
						
						{{ Form::reset(('Deshacer cambios'),array('class'=>'btn btn-default')) }}
					</p>

			{{ Form::close() }}


		</div><!-- End col-xs-4 -->
	</div>

@stop