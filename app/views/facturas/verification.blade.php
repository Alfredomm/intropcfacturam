@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Creación de {{ $tipo }} ( para {{ $tipologia }} )</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('facturas.createtipo', $tipo) }}">Atras</a>
	<!-- {{ HTML::linkRoute('clientes.index', 'Llista de clientes') }} -->

	<div class="row">

		<div class="col-md-6">

			{{ Form::model( $cliente, array( 'method' => 'POST', 'route' => 'facturas.createline', 'role' => 'form' ) ) }}
			
				{{ Form::token() }}
				{{ Form::hidden('cliente_id', $cliente->id) }}
				{{ Form::hidden('tipo', $tipo) }}
				{{ Form::hidden('tipologia', $tipologia) }}

					<p class="form-group">
						{{ Form::label('nombre', 'Nombre') }}
						{{ Form::text('nombre', Input::old('nombre'), array('class'=>'form-control', 'disabled')) }}
					</p>

					<p class="form-group">
						{{ Form::label('apellido1', 'Primer apellido') }}
						{{ Form::text('apellido1', Input::old('apellido1'), array('class'=>'form-control', 'disabled')) }}
					</p>

					<p class="form-group">
						{{ Form::label('apellido2', 'Segundo apellido') }}
						{{ Form::text('apellido2', Input::old('apellido2'), array('class'=>'form-control', 'disabled')) }}
					</p>

					<p class="form-group">
						{{ Form::label('dni_cif', 'Dni/Cif') }}
						{{ Form::text('dni_cif', Input::old('dni_cif'), array('class'=>'form-control', 'disabled')) }}
					</p>

					<p class="form-group">
						{{ Form::label('direccion', 'Dirección') }}
						{{ Form::text('direccion', Input::old('direccion'), array('class'=>'form-control', 'disabled')) }}
					</p>

					<p class="form-group">
						{{ Form::label('codigo_postal', 'Código postal') }}
						{{ Form::text('codigo_postal', $cliente->postalcodigo->codigo_postal, array('class'=>'form-control', 'disabled')) }}
					</p>
						
					<p class="form-group">
						@if( $tipo == 'facturas' )
								{{ Form::submit(('Crear factura'),array('class'=>'btn btn-success boto2')) }}						
						@elseif( $tipo == 'presupuestos' )
								{{ Form::submit(('Crear presupuesto'),array('class'=>'btn btn-success boto2')) }}						
						@elseif( $tipo == 'borradores' )
								{{ Form::submit(('Crear borrador'),array('class'=>'btn btn-success boto2')) }}
						@endif
						
					</p>
		</div><!-- end of col-md-6 -->

		<div class="col-md-6">
			
					<p class="form-group">
						{{ Form::label('dia', 'Dia') }}
						{{ Form::select('dia', $dias , date('d'), array('class' => 'form-control')) }}
					</p>

					<p class="form-group">
						{{ Form::label('mes', 'Mes') }}
						{{ Form::select('mes', $meses, date('m'), array('class' => 'form-control')) }}
					</p>

					<p class="form-group">
						{{ Form::label('anyo', 'Año') }}
						{{ Form::select('anyo', $anyos, date('o'), array('class' => 'form-control')) }}
					</p>

			{{ Form::close() }}

		</div><!-- End col-md-6 -->
	
	</div><!-- End row -->

@stop