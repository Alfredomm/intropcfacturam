@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Introducción de entidad</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empresas.index') }}">Lista de empresas</a>

	@if( $errors->has() )
		
		<div class="meserror">

			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

	{{ Form::open( array( 'method' => 'POST', 'route' => 'empresas.store' ) ) }}
	
		{{ Form::token() }}
		{{ Form::hidden('contacto', 'empresa') }}

			<div class="col-md-6">

				<p>
					{{ Form::label('nombre', 'Nombre') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('cif', 'Cif') }}
					{{ Form::text('cif', Input::old('cif'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('direccion', 'Direccion') }}
					{{ Form::text('direccion', Input::old('direccion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('sitio_web', 'Sitio Web') }}
					{{ Form::text('sitio_web', Input::old('sitio_web'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('cuenta_corriente', 'Cuenta Corriente') }}
					{{ Form::text('cuenta_corriente', Input::old('cuenta_corriente'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('poblaciones_lista', 'Poblaciones Lista') }}
					{{ Form::select('poblaciones_lista', $postalcodigos, Input::old('poblaciones_lista'), array('class'=>'form-control')) }}
					(Si la població no està a la llista i has d'introduïr una nova, sel·lecciona la primera opció de la llista "---")<br>

					{{ Form::label('poblacion', 'Población') }}
					{{ Form::text('poblacion', Input::old('poblacion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('provincias_lista') }}
					{{ Form::select('provincias_lista', $provincias, Input::old('provincias_lista'), array('class'=>'form-control')) }}
					(Si la provincia no està a la llista i has d'introduïr una nova, sel·lecciona la primera opció de la llista "---")<br>
					
						{{ Form::label('provincia', 'Provincia') }}
						{{ Form::text('provincia', Input::old('provincia'), array('class'=>'form-control')) }}
					</p>

					<p>
						{{ Form::label('codigo_postal', 'Codigo postal') }}
						{{ Form::text('codigo_postal', Input::old('codigo_postal'), array('class'=>'form-control')) }}
					</p>
					
				<p>
					{{ Form::submit(('Guardar'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-md-6 -->

	{{ Form::close() }}
	
	</div><!-- End row -->

@stop