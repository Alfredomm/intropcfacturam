@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Introducción de iva</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('tiposiva.index') }}">Lista de iva</a>

	<p><b>Los campos con * son obligatorios</b></p>

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

	{{ Form::open( array( 'method' => 'POST', 'route' => 'tiposiva.store' ) ) }}
	
		{{ Form::token() }}

			<div class="col-md-2">

				<p>
					{{ Form::label('tipo', 'Tipo *') }}
					{{ Form::text('tipo', Input::old('tipo'), array('class' => 'form-control')) }}
				</p>

			</div><!-- End col-md-2 -->

			<div class="col-md-1">

				<p>
					{{ Form::label('iva', 'IVA *') }}
					{{ Form::text('iva', Input::old('iva'), array('class' => 'form-control')) }}
				</p>

			</div><!-- End col-md-1 -->

	</div><!-- End row -->

	<div class="row">

			<div class="col-md-8">

			<p>
				{{ Form::submit(('Guardar y añadir tipo'),array('class'=>'btn btn-success boto2')) }}
				
				{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
			</p>

			</div><!-- End col-md-8 -->

	{{ Form::close() }}

	</div><!-- End row -->

@stop