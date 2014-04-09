@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar tipo</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('tiposiva.index') }}">Volver al listado</a>

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('tipo', '<li>:message</li>') }}
				{{ $errors->first('iva', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		{{ Form::model($tipoiva, array( 'method' => 'PUT', 'route' => 'tiposiva.update' ) ) }}
		
			{{ Form::token() }}

			{{ Form::hidden('id', $tipoiva->id) }}

			<div class="col-xs-4">

				<p>
					{{ Form::label('tipo', 'Tipo') }}
					{{ Form::text('tipo', Input::old('tipo'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('iva', 'IVA') }}
					{{ Form::text('iva', Input::old('iva'), array('class' => 'form-control')) }}
				</p>
					
				<p>
					{{ Form::submit(('Guardar cambios'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-xs-4 -->

		</div><!-- End row -->

	{{ Form::close() }}

@stop