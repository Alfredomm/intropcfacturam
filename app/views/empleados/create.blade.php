@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Introducción de empleado</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empleados.index') }}">Listado de empleados</a>
	<!-- {{ HTML::linkRoute('empleados.index', 'Llista de empleados') }} -->

	<p><b>Los campos con * son obligatorios</b></p>

	@if( $errors->has() )
		
		<div class="meserror">
			<p>
				Hi ha hagut alguns errors:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('codigo_postal', '<li>:message</li>') }}
				{{ $errors->first('poblacion', '<li>:message</li>') }}
				{{ $errors->first('provincia', '<li>:message</li>') }}
			</ul>
		</div>

	@endif

	<div class="row">

	{{ Form::open( array( 'method' => 'POST', 'route' => 'empleados.store' ) ) }}
	
		{{ Form::token() }}
		{{ Form::hidden('contacto', 'empleado') }}

			<div class="col-md-6">
				<p>
					{{ Form::label('nombre', 'Nombre *') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('apellido1', 'Primer apellido') }}
					{{ Form::text('apellido1', Input::old('apellido1'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('apellido2', 'Segundo apellido') }}
					{{ Form::text('apellido2', Input::old('apellido2'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('dni', 'Dni') }}
					{{ Form::text('dni', Input::old('dni'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('direccion', 'Adreça') }}
					{{ Form::text('direccion', Input::old('direccion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('cuenta_corriente', 'Cuenta corriente') }}
					{{ Form::text('cuenta_corriente', Input::old('cuenta_corriente'), array('class'=>'form-control')) }}
				</p>
					
				<p>
					{{ Form::label('tipos_lista', 'Función') }}
					{{ Form::select('tipos_lista', $tipos, Input::old('tipos_lista')) }}
					(Si la función no está en la lista y tienes que introducir una nueva, selecciona la primera opción de la lista "---")
				</p>

				<p>
					{{ Form::label('tipo', 'Función') }}
					{{ Form::text('tipo', Input::old('tipo'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('permisos_lista', 'Permisos') }}
					{{ Form::select('permisos_lista', $permisos, Input::old('permisos_lista')) }}
					(Si la función no está en la lista y tienes que introducir una nueva, selecciona la primera opción de la lista "---")
				</p>

				<p>
					{{ Form::label('permisos', 'Permisos de la aplicación') }}
					{{ Form::text('permisos', Input::old('permisos'), array('class'=>'form-control')) }}
				</p>
			</div><!-- End col-md-6 -->
			<div class="col-md-6">
				<p>
					{{ Form::label('poblaciones_lista', 'Población') }}
					{{ Form::select('poblaciones_lista', $postalcodigos, Input::old('poblaciones_lista'), array('class'=>'form-control')) }}
					(Si la població no està a la llista i has d'introduïr una nova, sel·lecciona la primera opció de la llista "---")
				</p>
				<p>
					{{ Form::label('poblacion', 'Población') }}
					{{ Form::text('poblacion', Input::old('poblacion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('provincias_lista') }}
					{{ Form::select('provincias_lista', $provincias, Input::old('provincias_lista'), array('class'=>'form-control')) }}
					(Si la provincia no està a la llista i has d'introduïr una nova, sel·lecciona la primera opció de la llista "---")
				</p>
				<p>
					{{ Form::label('provincia', 'Provincia') }}
					{{ Form::text('provincia', Input::old('provincia'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('codigo_postal', 'Codigo postal') }}
					{{ Form::text('codigo_postal', Input::old('codigo_postal'), array('class'=>'form-control')) }}
				</p>
				
				<p>
					{{ Form::submit(('Guardar y añadir contacto'),array('class'=>'btn btn-primary')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default')) }}
				</p>
			</div><!-- End col-md-6 -->

	{{ Form::close() }}
	
	</div><!-- End row -->

@stop