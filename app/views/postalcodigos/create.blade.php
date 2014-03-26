@extends('plantillas.default')

@section('header')

@parent

	<h2 class="subtitol1">Crear población</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('postalcodigos.index') }}">Listado de poblaciones</a>
	<!-- {{ HTML::linkRoute('postalcodigos.index', 'Llistat de poblacions') }} -->

	<p><b>Los campos con * son obligatorios</b></p>

	@if( $errors->has() )

		<div class="meserror">

			<p>
				Ha habido algunos errores: 
			</p>

			<ul>
				{{ $errors->first('codigo_postal', '<li>:message</li>') }}
				{{ $errors->first('poblacion', '<li>:message</li>') }}
				{{ $errors->first('provincia', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">
	
		{{ Form::open(array('method' => 'POST', 'route' => 'postalcodigos.store')) }}

			{{ Form::token() }}

			<div class="col-xs-6">

				<p>
					{{ Form::label('poblacion', 'Población *') }}
					{{ Form::text('poblacion', Input::old('poblacion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('provincias_lista') }}
					{{ Form::select('provincias_lista', $provincias, Input::old('provincias_lista'), array('class'=>'form-control')) }}
					(Si la provincia no está a la lista y tienes que introducir una nueva, selecciona la primera opción de la lista "---")<br>

					{{ Form::label('provincia', 'Provincia *') }}
					{{ Form::text('provincia', Input::old('provincia'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('codigo_postal', 'Codigo postal *') }}
					{{ Form::text('codigo_postal', Input::old('codigo_postal'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::submit(('Guardar'),array('class'=>'btn btn-success boto2')) }}
						
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-xs-6 -->

		{{ Form::close() }}

	</div><!-- End row -->

@stop