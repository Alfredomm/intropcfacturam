@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Resumen anual</h2>

@stop

@section('content')

	<div class="campobusquedar">

		<div class="row">

			{{ Form::open(array( 'method' => 'GET', 'route' => 'facturas.resumen' ) ) }}

				{{ Form::token() }}

				<div class="col-md-3">

					{{ Form::label('iva', 'Busqueda por IVA:') }}
					{{ Form::select('iva', $tipoiva, $selected = null, array('class'=>'form-control')) }}

				</div><!-- End col-md-3 -->

				<div class="col-md-3">

					{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info boto5')) }}

				</div><!-- End col-md-3 -->

			{{ Form::close() }}

		</div><!-- End row -->

		<br>

		<div class="row">

			{{ Form::open(array( 'method' => 'GET', 'route' => 'facturas.resumen' ) ) }}

				{{ Form::token() }}

				<div class="col-md-3">

					{{ Form::label('bfecha', 'Fecha inicial:') }}
					<p>Mes</p>
					{{ Form::select('mesesini', $mesesini, $selected = null, array('class'=>'form-control')) }}
					<p>Año</p>
					{{ Form::select('anyosini', $anyosini, $selected = null, array('class'=>'form-control')) }}

					</div><!-- End col-md-3 -->

					<div class="col-md-3">

						{{ Form::label('bfecha', 'Fecha final:') }}
						<p>Mes</p>
						{{ Form::select('mesesfin', $mesesfin, $selected = null, array('class'=>'form-control')) }}
						<p>Año</p>
						{{ Form::select('anyosfin', $anyosfin, $selected = null, array('class'=>'form-control')) }}

					</div><!-- End col-md-3 -->

					{{ Form::button('Buscar periodo', array('type' => 'submit', 'class' => 'btn btn-info boto5')) }}

			{{ Form::close() }}

		</div><!-- End row -->

	</div><!-- End campobusquedar -->

		<table class="table table-hover tabla_lista_clientes tabres1">
			<thead>
				<tr>
					<td>Numero de cliente:</td>
					<td>IVA:</td>
					<td>Base imponible:</td>
					<td>Total:</td>
					<td>Cliente:</td>
				</tr>
			</thead>
			<tbody>

			@if( $flag == 0 )
				@foreach( $facturalinea as $flin )
			
				<tr>
					<td>
						{{ $flin->factura->cliente->id }}
					</td>
					<td>
						{{ $flin->iva }}
					</td>
					<td>
						{{ $flin->subtotal }}
					</td>
					<td>
						{{ round((($flin->subtotal)*(($flin->iva)/100))+$flin->subtotal,2) }}
					</td>
					<td>
						{{ $flin->factura->cliente->nombre }}
					</td>
				</tr>

				@endforeach
			@endif

			@if( $flag == 1 )
				@foreach( $facturalinea as $flin )
			
				<tr>
					<td>
						{{ $flin->cliente->id }}
					</td>
					<td>
						{{ $flin }}
					</td>
					<td>
						{{ $flin->subtotal }}
					</td>
					<td>
						{{ round((($flin->subtotal)*(($flin->iva)/100))+$flin->subtotal,2) }}
					</td>
					<td>
						{{ $flin->cliente->nombre }}
					</td>
				</tr>

				@endforeach
			@endif
			</tbody>
		</table>

@stop