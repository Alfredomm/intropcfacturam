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

				<div class="col-md-2">

					{{ Form::label('anyo', 'Año') }}
					{{ Form::select('anyo', $anyos, 0, array('class' => 'form-control')) }}

				</div><!-- End col-md-2 -->

				<div class="col-md-3">

					{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info boto5')) }}

				</div><!-- End col-md-3 -->

			{{ Form::close() }}

		</div><!-- End row -->

	</div><!-- End campobusquedar -->

	<div class="tablaresultados">

		<table class="tabtotalres" border="1">
			<tr>
				<td colspan="4">RESUMEN ANUAL</td>
			</tr>
			<tr>
				<td colspan="2">Ganancias</td><td colspan="2">Deben</td>
			</tr>
			<tr>
				<td>Venta</td><td>Alquiler</td><td>Venta</td><td>Alquiler</td>
			</tr>
			<tr>
				<td>{{ $sumaventasganan }}</td><td>{{ $sumalquilerganan }}</td><td>{{ $sumaventasdeuda }}</td><td>{{ $sumalquilerdeuda }}</td>
			</tr>
			<tr>
				<td colspan="2"><b>TOTAL GANANCIAS:</b> {{ $sumabeneficiototal }}</td><td colspan="2"><b>TOTAL DEBEN:</b> {{ $sumadeudatotal }}</td>
			</tr>
		</table>

	</div><!-- End tablaresultados -->

	<ul class="nav nav-tabs tabsresumen">
		<li class="tabsresumen2 active"><a href="#docventa" data-toggle="tab">Venta</a></li>
		<li class="tabsresumen2"><a href="#docalquiler" data-toggle="tab">Alquiler</a></li>
		<li class="tabsresumen2"><a href="#docrectificaiva" data-toggle="tab">Rectificativa</a></li>
	</ul>

	<div class="tab-content">

		<div class="tab-pane active" id="docventa">

			<table class="table table-hover tabla_lista_clientes tabres1">
				<thead>
					<tr>
						<td>Numero:</td>
						<td>Fecha de emision:</td>
						<td class="tabla-resumen-columna-cliente">Cliente:</td>
						<td>Base imponible:</td>
						<td>IVA:</td>
						<td>Total:</td>
						<td>Fecha de cobro:</td>
					</tr>
				</thead>
				<tbody>
					@foreach( $facturasventa as $fact )
				
					<tr>
						<td>
							<a class="btn btn-default" href="{{ route('facturas.createlineshow', array('facturas', $fact->id)) }}">{{ 'VE '.substr($fact->fecha, 2, 2).'/'.$fact->num_factura }}</a>
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ substr($fact->fecha, 6, 2).'-'.substr($fact->fecha, 4, 2).'-'.substr($fact->fecha, 0, 4) }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->cliente->nombre }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->total }}
						</td>
						<td>
							{{ $ajustes->iva }}
						</td>
						<td>
							{{ ((($ajustes->iva)/100)*($fact->total))+($fact->total) }}
						</td>
						<td>
							{{ substr($fact->fecha_pagado, 6, 2).'-'.substr($fact->fecha_pagado, 4, 2).'-'.substr($fact->fecha_pagado, 0, 4) }}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

		</div><!-- End tab-pane -->

		<div class="tab-pane" id="docalquiler">

			<table class="table table-hover tabla_lista_clientes tabres1">
				<thead>
					<tr>
						<td>Numero:</td>
						<td>Fecha de emision:</td>
						<td class="tabla-resumen-columna-cliente">Cliente:</td>
						<td>Base imponible:</td>
						<td>IVA:</td>
						<td>Total:</td>
						<td>Fecha de cobro:</td>
					</tr>
				</thead>
				<tbody>
					@foreach( $facturasalquiler as $fact )
				
					<tr>
						<td>
							<a class="btn btn-default" href="{{ route('facturas.createlineshow', array('facturas', $fact->id)) }}">{{ 'AL '.substr($fact->fecha, 2, 2).'/'.$fact->num_factura }}</a>
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ substr($fact->fecha, 6, 2).'-'.substr($fact->fecha, 4, 2).'-'.substr($fact->fecha, 0, 4) }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->cliente->nombre }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->total }}
						</td>
						<td>
							{{ $ajustes->iva }}
						</td>
						<td>
							{{ ((($ajustes->iva)/100)*($fact->total))+($fact->total) }}
						</td>
						<td>
							{{ substr($fact->fecha_pagado, 6, 2).'-'.substr($fact->fecha_pagado, 4, 2).'-'.substr($fact->fecha_pagado, 0, 4) }}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

		</div><!-- End tab-pane -->

		<div class="tab-pane" id="docrectificaiva">

			<table class="table table-hover tabla_lista_clientes tabres1">
				<thead>
					<tr>
						<td>Numero:</td>
						<td>Fecha de emision:</td>
						<td class="tabla-resumen-columna-cliente">Cliente:</td>
						<td>Base imponible:</td>
						<td>IVA:</td>
						<td>Total:</td>
						<td>Fecha de cobro:</td>
					</tr>
				</thead>
				<tbody>
					@foreach( $facturasrectificativa as $fact )
				
					<tr>
						<td>
							<a class="btn btn-default" href="{{ route('facturas.createlineshow', array('facturas', $fact->id)) }}">{{ 'RE '.substr($fact->fecha, 2, 2).'/'.$fact->num_factura }}</a>
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ substr($fact->fecha, 6, 2).'-'.substr($fact->fecha, 4, 2).'-'.substr($fact->fecha, 0, 4) }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->cliente->nombre }}
						</td>
						<td class="tabla-resumen-columna-cliente">
							{{ $fact->total }}
						</td>
						<td>
							{{ $ajustes->iva }}
						</td>
						<td>
							{{ ((($ajustes->iva)/100)*($fact->total))+($fact->total) }}
						</td>
						<td>
							{{ substr($fact->fecha_pagado, 6, 2).'-'.substr($fact->fecha_pagado, 4, 2).'-'.substr($fact->fecha_pagado, 0, 4) }}
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

		</div><!-- End tab-pane -->

	</div><!-- End tab-content -->

@stop