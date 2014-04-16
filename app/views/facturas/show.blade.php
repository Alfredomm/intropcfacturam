<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	{{ HTML::style('css/factura.css') }}
</head>
<body>
	<div class="wrapper">
		
		<table class="datos-empresa">
			<tbody>
				<tr>
					<td>
						
					</td>
				</tr>
				<tr>
					<td>
						<b>{{ $empresa->nombre }}</b>
					</td>
				</tr>
				<tr>
					<td>
						CIF {{ $empresa->cif }}
					</td>
				</tr>
				<tr>
					<td>
						{{ $empresa->direccion }}
					</td>
				</tr>
				<tr>
					<td>
						@if( count($empresa->postalcodigo) != 0 ) {{ $empresa->postalcodigo->codigo_postal }} - {{ $empresa->postalcodigo->poblacion }} ({{ $empresa->postalcodigo->provincia }}) @endif
					</td>
				</tr>
				@if( $factura->direccion2 == 1 )
					<tr>
						<td>
							@if( !empty($empresa2) ) {{ $empresa2->direccion }} @endif
						</td>
					</tr>
					<tr>
						<td>
							@if( !empty($empresa2) && $empresa2->postalcodigo_id != 0 ) {{ $empresa2->postalcodigo->codigo_postal }} - {{ $empresa2->postalcodigo->poblacion }} ({{ $empresa2->postalcodigo->provincia }}) @endif
						</td>
					</tr>
				@endif
				<tr>
					<td>
						Tfo: @if( count($empresa->telefonos) != 0) {{ $empresa->telefonos[0]->telefono }} @endif
					</td>
				</tr>
				<tr>
					<td>
						Fax: @if( count($empresa->faxs) != 0 ) {{ $empresa->faxs[0]->fax }} @endif
					</td>
				</tr>
				<tr>
					<td>
						Email: @if( count($empresa->emails) != 0 ) {{ $empresa->emails[0]->email }} @endif
					</td>
				</tr>
			</tbody>
		</table>

		<div class="resumen-linea-cliente"></div>
		<div class="resumen-linea-fecha"></div>

		<table class="resumen-cliente-fecha">
			<tbody>
				<tr>
					<td>
						Cliente
					</td>
					<td>
						Fecha
					</td>
					<td>
						Nº Factura
					</td>
				</tr>
			</tbody>
		</table>

		<table class="resumen-cliente-fecha-bajo">
			<tbody>
				<tr>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->id }} @endif
					</td>
					<td>
						{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
					</td>
					<td>
						@if( ($factura->venta == 1) && ($factura->rectificativa != 1) )
							VE 
						@endif
						@if( ($factura->venta == 0) && ($factura->rectificativa != 1))
							AL 
						@endif
						@if( $factura->rectificativa == 1 )
							RE
						@endif
						@if( $factura->presupuesto != 1 )
							@if( $factura->rectificativa != 1 )
								{{ date('y') }}/
							@endif
						@endif
						{{ $factura->num_factura }}
					</td>
				</tr>
			</tbody>
		</table>

		<table class="datos-cliente">
			<tbody>
				<tr>
					<td>
						Nombre 
					</td>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->nombre.' '.$factura->cliente->apellido1.'<br/>'.$factura->cliente->apellido2 }} @endif
					</td>
				</tr>
				<tr>
					<td>
						Dirección
					</td>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->direccion }} @endif
					</td>
				</tr>
				<tr>
					<td>
						Código postal
					</td>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->postalcodigo->codigo_postal }} @endif
					</td>
				</tr>
				<tr>
					<td>
						Población
					</td>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->postalcodigo->poblacion }} @endif
					</td>
				</tr>
			</tbody>
		</table>
		@if( $factura->presupuesto == 1 )
			<table class="presupuesto">
				<tbody>
					<tr>
						<td>
							presupuesto de @if( $factura->venta == 1 ) venta @else alquiler @endif
						</td>
					</tr>
				</tbody>
			</table>
		@endif

		<table class="cif">
			<tbody>
				<tr>
					<td>
						CIF-NIF
					</td>
					<td>
						@if( count($factura->cliente) != 0 ) {{ $factura->cliente->dni_cif }} @endif
					</td>
				</tr>
			</tbody>
		</table>

		<div class="vertical-linea-ud"></div>
		<div class="vertical-linea-dias"></div>
		<div class="vertical-linea-precio"></div>
		<div class="vertical-linea-dto"></div>
		
		@if( $factura->venta != 1 )
			<div class="vertical-linea-descripcion"></div>
			<div class="factura-lineas-container">
				<table class="factura-lineas-tabla-head">
					<thead>
						<tr>
							<th>
								Descripción
							</th>
							<th>
								UD
							</th>
							<th>
								DÍAS
							</th>
							<th>
								Precio UD
							</th>
							<th>
								IVA
							</th>
							<th>
								Total
							</th>
						</tr>
					</thead>
				</table>
				<table class="factura-lineas-tabla-body">
					<tbody>
						<!-- foreach facturalineas -->
						<?php $suma = 0; ?>
						@foreach( $facturalineas as $fl )
						<tr>
							@if( $fl->material != NULL )
								<td>{{$fl->material->nombre}}</td>
								<?php $suma += $fl->subtotal ?>
							@else
								<td>{{$fl->nombre}}</td>
								<?php $suma += $fl->subtotal ?>
							@endif
								<td>
									@if( $fl->cantidad_material != 0 )
										{{$fl->cantidad_material}}
									@endif
								</td>
								<td>
									@if( $fl->dias != 0 )
										{{$fl->dias}}
									@endif
								</td>
								<td>
									@if( $fl->precio != 0 )
										{{$fl->precio}}
									@endif
								</td>
								<td>
									@if( $fl->descuento != 0 )
										{{$fl->descuento}}
									@endif
								</td>
								<td>
									@if( $fl->subtotal != 0 )
										@if($factura->rectificativa == 1)
										-
										@endif
										{{$fl->subtotal}}
									@endif
								</td>
							</tr>
						@endforeach
						<!-- end foreach -->
					</tbody>
				</table>
			</div>
		@else
			<div class="factura-lineas-container">
				<table class="factura-lineas-tabla-head-venta">
					<thead>
						<tr>
							<th>
								Descripción
							</th>
							<th>
								UD
							</th>
							<th>
								Precio UD
							</th>
							<th>
								IVA
							</th>
							<th>
								Total
							</th>
						</tr>
					</thead>
				</table>
				<table class="factura-lineas-tabla-body-venta">
					<tbody>
						<!-- foreach facturalineas -->
						<?php $suma = 0; ?>
						@foreach( $facturalineas as $fl )
						<tr>
							@if( $fl->material != NULL )
								<td>{{$fl->material->nombre}}</td>
								<?php $suma += $fl->subtotal ?>
							@else
								<td>{{$fl->nombre}}</td>
								<?php $suma += $fl->subtotal ?>
							@endif
								<td>
									@if( $fl->cantidad_material != 0 )
										{{$fl->cantidad_material}}
									@endif
								</td>
								<td>
									@if( $fl->precio != 0 )
										{{$fl->precio}}
									@endif
								</td>
								<td>
									{{ $fl->iva }}
								</td>
								<td>
									@if( $fl->subtotal != 0 )
										@if($factura->rectificativa == 1)
										-
										@endif
										{{$fl->subtotal}}
									@else
										-
									@endif
								</td>
							</tr>
						@endforeach
						<!-- end foreach -->
					</tbody>
				</table>
			</div>
		@endif

		<table class="total-head">
			<thead>
				<tr>
					<th>
						Observaciones
					</th>
					<th>
						Pagado
					</th>
					<th>
						Base imponible
					</th>
					<th>
						Total
					</th>
				</tr>
			</thead>
		</table>
		
		<div class="total-linea-obs"></div>
		<div class="total-linea-base"></div>
		<div class="total-linea-iva"></div>

		<table class="total-body">
			<tbody>
				<tr>
					<td>
						{{ $factura->observaciones }}
					</td>
					<td>
						<span class="total-body-texto">

						</span>
					</td>
					<td>
						<span class="total-body-texto">
							@if($factura->rectificativa == 1)
							-
							@endif
							<?php $sum = 0; ?>
							@foreach( $factura->facturalineas as $fl )

								<?php $sum += ($fl->cantidad_material)*($fl->precio); ?>

							@endforeach
							{{ $sum }}
						</span>
					</td>
					<td>
						<span class="total-body-texto">
							@if($factura->rectificativa == 1)
							-
							@endif
							{{ number_format((float)round($suma, 2), 2, '.', '') }}
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="cc">
			@if( $factura->presupuesto != 1 && $factura->borrador != 1 )
				<span>
					Nº CC {{ $empresa->cuenta_corriente }}
				</span>
			@endif
		</div>
	</div><!-- end of wrapper -->
</body>
</html>