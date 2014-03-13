@extends('plantillas.default')

@section('header')

	@parent

	<h2 class="subtitol1">Editar población</h2>

@stop

@section('content')
	
	<a class="btn btn-primary boto1" href="{{ route('postalcodigos.show',$postalcodigo->id) }}">Volver a la población</a>
	<!-- {{ HTML::linkRoute('postalcodigos.index', 'Llistat de poblacions') }} -->

	@if( $errors->has() )

		<div class="meserror">

			<p>Ha habido algunos errores</p>

			<ul>
				{{ $errors->first('codigo_postal', '<li>:message</li>') }}
				{{ $errors->first('poblacion', '<li>:message</li>') }}
				{{ $errors->first('provincia', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		<div class="col-xs-6">

			{{ Form::model( $postalcodigo, array('method' => 'PUT', 'route' => 'postalcodigos.update') ) }}

				{{ Form::token() }}

				{{ Form::hidden('id', $postalcodigo->id) }}
				{{ Form::hidden('prevUrl', URL::previous()) }}

					<p>
						{{ Form::label('poblacion', 'Población') }}
						{{ Form::text('poblacion', Input::old('poblacion'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::label('provincia', 'Provincia') }}
						{{ Form::text('provincia', Input::old('provincia'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::label('codigo_postal', 'Código postal') }}
						{{ Form::text('codigo_postal', Input::old('codigo_postal'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::submit(('Guardar'),array('class'=>'btn btn-success boto2')) }}
						
						{{ Form::reset(('Deshacer cambios'),array('class'=>'btn btn-default boto2')) }}
					</p>

			{{ Form::close() }}

		</div><!-- End col-xs-6 -->

	</div>

@stop