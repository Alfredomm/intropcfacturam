@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Introducción de cliente</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('clientes.index') }}">Lista de clientes</a>

	<p><b>Los campos con * son obligatorios</b></p>

	@if( $errors->has() )
		
		<div class="meserror">

			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('poblacion', '<li>:message</li>') }}
				{{ $errors->first('provincia', '<li>:message</li>') }}
				{{ $errors->first('codigo_postal', '<li>:message</li>') }}				
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

	{{ Form::open( array( 'method' => 'POST', 'route' => 'clientes.store' ) ) }}
	
		{{ Form::token() }}
		{{ Form::hidden('contacto', 'cliente') }}

			<div class="col-md-6">

				<p>
					{{ Form::label('nombre', 'Nombre *') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'autofocus' => true)) }}
				</p>

				<p>
					{{ Form::label('apellido1', 'Apellidos') }}
					{{ Form::text('apellido1', Input::old('apellido1'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('apellido2', 'Segunda linea factura') }}
					{{ Form::text('apellido2', Input::old('apellido2'), array('class'=>'form-control')) }}
					Esta es la linea que aparecera debajo del nombre en la factura, utilizalo para especificaciones concretas<br>
				</p>

				<p>
					{{ Form::label('dni_cif', 'Dni / Cif') }}
					{{ Form::text('dni_cif', Input::old('dni_cif'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('direccion', 'Dirección') }}
					{{ Form::text('direccion', Input::old('direccion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('sitio_web', 'Página web') }}
					{{ Form::text('sitio_web', Input::old('sitio_web'), array('class'=>'form-control')) }}
				</p>

			</div><!-- End col-md-6 -->

			<div class="col-md-6">

				<p>
					{{ Form::label('poblaciones_lista', 'Poblaciones Lista') }}
					{{ Form::select('poblaciones_lista', $postalcodigos, Input::old('poblaciones_lista'), array('class'=>'form-control')) }}
					(Si la población no está en la lista y tienes que introducir una nueva, selecciona la primera opción de la lista "---")<br>

					{{ Form::label('poblacion', 'Población *') }}
					{{ Form::text('poblacion', Input::old('poblacion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('provincias_lista') }}
					{{ Form::select('provincias_lista', $provincias, Input::old('provincias_lista'), array('class'=>'form-control')) }}
					(Si la provincia no está a la lista y tienes que introducir una nueva, selecciona la primera opción de la lista "---")<br>
					
				<div class="espe1">

						{{ Form::label('provincia', 'Provincia *') }}
						{{ Form::text('provincia', Input::old('provincia'), array('class'=>'form-control')) }}
					</p>

					<p>
						{{ Form::label('codigo_postal', 'Codigo postal *') }}
						{{ Form::text('codigo_postal', Input::old('codigo_postal'), array('class'=>'form-control')) }}
					</p>
					
					<p>
						{{ Form::submit(('Guardar y añadir contacto'),array('class'=>'btn btn-success boto2')) }}
						
						{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
					</p>

				</div><!-- End espe1 -->

			</div><!-- End col-md-6 -->

	{{ Form::close() }}
	
	</div><!-- End row -->

@stop