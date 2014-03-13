@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar ajustes</h2>

@stop

@section('content')

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('iva', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

	{{ Form::model($ajustes, array( 'method' => 'PUT', 'route' => 'ajustes.update' ) ) }}
		
		{{ Form::token() }}

		{{ Form::hidden('id', $ajustes->id) }}

			<div class="col-xs-6">

				<p>
					{{ Form::label('iva', 'IVA') }}
					{{ Form::text('iva', Input::old('iva'), array('class' => 'form-control')) }}
				</p>
					
				<p>
					{{ Form::submit(('Guardar cambios'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-xs-6 -->

	</div><!-- End row -->

	{{ Form::close() }}

@stop