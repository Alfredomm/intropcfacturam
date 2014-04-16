@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Listado de {{ $tipo }}</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('facturas.createtipo', $tipo) }}">Crear {{ $tipo }}</a>

	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ HTML::linkRoute('empresas.index', $errors->first())  }} </h5> </div> @endif

	<div class="campobusquedaf">

		<div class="row">

			{{ Form::open(array( 'method' => 'GET', 'route' => 'facturas.search' ) ) }}

				{{ Form::token() }}
				{{ Form::hidden('tipo', $tipo) }}

				<div class="col-md-3">

					{{ Form::label('clientes', 'Cliente') }}
					{{ Form::text('clientes', null, array('class' => 'form-control', 'autofocus' => true)) }}

				</div><!-- End col-md-3 -->

				<div class="col-md-2">

					{{ Form::label('mes', 'Mes') }}
					{{ Form::select('mes', $meses, 0, array('class' => 'form-control')) }}

				</div><!-- End col-md-3 -->

				<div class="col-md-2">

					{{ Form::label('anyo', 'Año') }}
					{{ Form::select('anyo', $anyos, 0, array('class' => 'form-control')) }}

				</div><!-- End col-md-3 -->

				<div class="col-md-3">

					{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info boto5')) }}

				</div><!-- End col-md-3 -->

			{{ Form::close() }}

		</div><!-- End row -->

		<div class="row">

			{{ Form::open(array( 'method' => 'GET', 'route' => 'facturas.searchnum' )) }}

				{{ Form::token() }}
				{{ Form::hidden('tipo', $tipo) }}

				<div class="separacionum">

					<div class="col-md-3">

						{{ Form::label('numerofactura', 'Numero de factura') }}
						{{ Form::text('numerofactura', null, array('class' => 'form-control')) }}

					</div><!-- End col-md-3 -->

					<div class="col-md-3">

						{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info boto5')) }}

					</div><!-- End col-md-3 -->

				</div><!-- End separacionum -->

			{{ Form::close() }}

		</div><!-- End row -->

	</div><!-- End campobusquedaf -->

	<ul class="nav nav-tabs arreglotabs">
		<li 
		@if($active == 'facturas')
			class="active arreglotabs3"
		@else
			class="active arreglotabs2"
		@endif
		><a href="#docventa" data-toggle="tab">Venta <div class="contador-documentos">{{ count($facturasventa) }}</div></a></li>
		<li 
		@if($active == 'facturas')
			class="arreglotabs3"
		@else
			class="arreglotabs2"
		@endif
		><a href="#docalquiler" data-toggle="tab">Alquiler <div class="contador-documentos">{{ count($facturasalquiler) }}</div></a></li>
		@if( $active == 'facturas' )
			<li 
			@if($active == 'facturas')
				class="arreglotabs3"
			@else
				class="arreglotabs2"
			@endif
			><a href="#docrectificativa" data-toggle="tab">Rectificativa <div class="contador-documentos">{{ count($facturasrectificativa) }}</div></a></li>
		@endif
	</ul>

	<div class="tab-content">

		<div class="tab-pane active" id="docventa">

			<table class="table table-hover tabla_lista_facturas">
				<thead>
					<tr>
						<td>
							Numero
						</td>
						<td>
							Cliente
						</td>
						<td>
							Fecha
						</td>
						<td>
							Total
						</td>
						@if( $active == 'facturas' )
							<td class="lista-factura-pagado">
								Pagado
							</td>
						@endif
						<td>
							Operaciones
						</td>
					</tr>
				</thead>
				<tbody>

					@foreach( $facturasventa as $factura )

						@if( ($factura->presupuesto == 1) && ($active == 'presupuestos') )

							<tr>
								<td>
									<a class="btn btn-default" href="{{ route('facturas.createlineshow', array($tipo, $factura->id)) }}">{{ 'VE '.substr($factura->fecha, 2, 2).'/'.$factura->num_factura }}</a>
								</td>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td>
									
									<a class="btn btn-primary" href="{{ route('facturas.convert', $factura->id) }}">Convertir a factura</a>
								</td>
							</tr>

						@endif

						@if( ($factura->borrador == 1) && ($active == 'borradores') )

							<tr>
								<td>
									
								</td>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td>
									
									<a class="btn btn-primary " href="{{ route('facturas.convert', $factura->id) }}">Convertir a factura</a>
									{{ Form::open(array( 'route' => 'facturas.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
										{{ Form::token() }}
										{{ Form::hidden('id', $factura->id) }}
										{{ Form::hidden('tipo', $tipo) }}
										{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un borrador de tu base da datos, seguro que queires proceder?")')) }}
									{{ Form::close() }}
								</td>
							</tr>

						@endif

						@if( ($factura->borrador == 0) && ($factura->presupuesto == 0) && ($factura->rectificativa == 0) && ($active == 'facturas') )
						
							<tr>
								<td>
									<a class="btn btn-default" href="{{ route('facturas.createlineshow', array($tipo, $factura->id)) }}">{{ 'VE '.substr($factura->fecha, 2, 2).'/'.$factura->num_factura }}</a>
								</td>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td class="lista-factura-pagado">
									@if( strlen($factura->fecha_pagado) == 8 )
										<i class="glyphicon glyphicon-ok"></i></a>
									@endif
								</td>
								<td>
									
									@if( $factura->existe_rectificativa == 0 )
										<a class="btn btn-default" href="{{ route('facturas.convertRectificativa', $factura->id) }}">Rectificativa</a>
									@else
										<a class="btn btn-default" onclick='return confirm("Ya existe una factura rectificativa de esta factura de venta, seguro que quieres crear otra?")' href="{{ route('facturas.convertRectificativa', $factura->id) }}">Rectificativa</a>
									@endif
								</td>
							</tr>

						@endif

					@endforeach

				</tbody>
			</table>

			{{ $facturasventa->appends(Request::except('page'))->links() }}

		</div><!-- End tab-pane -->

		<div class="tab-pane" id="docalquiler">

			<table class="table table-hover tabla_lista_facturas">
				<thead>
					<tr>
						@if( ($active == 'borradores') )
						@else
							<td>
								Numero
							</td>
						@endif
						<td>
							Cliente
						</td>
						<td>
							Fecha
						</td>
						<td>
							Total
						</td>
						@if( $active == 'facturas' )
							<td>
								Pagado
							</td>
						@endif
						<td>
							Operaciones
						</td>
					</tr>
				</thead>
				<tbody>

					@foreach( $facturasalquiler as $factura )

						@if( ($factura->presupuesto == 1) && ($active == 'presupuestos') )
								
							<tr>
								<td>
									<a class="btn btn-default" href="{{ route('facturas.createlineshow', array($tipo, $factura->id)) }}">{{ 'AL '.substr($factura->fecha, 2, 2).'/'.$factura->num_factura }}</a>
								</td>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td>
									
									<a class="btn btn-primary " href="{{ route('facturas.convert', $factura->id) }}">Convertir a factura</a>
								</td>
							</tr>

						@endif

						@if( ($factura->borrador == 1) && ($active == 'borradores') )
						
							<tr>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td>
									
									<a class="btn btn-primary " href="{{ route('facturas.convert', $factura->id) }}">Convertir a factura</a>
									{{ Form::open(array( 'route' => 'facturas.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
										{{ Form::token() }}
										{{ Form::hidden('id', $factura->id) }}
										{{ Form::hidden('tipo', $tipo) }}
										{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un borrador de tu base da datos, seguro que queires proceder?")')) }}
									{{ Form::close() }}
								</td>
							</tr>

						@endif

						@if( ($factura->borrador == 0) && ($factura->presupuesto == 0) && ($factura->rectificativa == 0) && ($active == 'facturas') )
						
							<tr>
								<td>
									<a class="btn btn-default" href="{{ route('facturas.createlineshow', array($tipo, $factura->id)) }}">{{ 'AL '.substr($factura->fecha, 2, 2).'/'.$factura->num_factura }}</a>
								</td>
								<td>
									{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
								</td>
								<td>
									{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
								</td>
								<td>
									{{ number_format((float)round($factura->total,2), 2, '.', '') }}
								</td>
								<td>
									@if( strlen($factura->fecha_pagado) == 8 )
										<i class="glyphicon glyphicon-ok"></i></a>
									@endif
								</td>
								<td>
									
									@if( $factura->existe_rectificativa == 0 )
										<a class="btn btn-default" href="{{ route('facturas.convertRectificativa', $factura->id) }}">Rectificativa</a>
									@else
										<a class="btn btn-default" onclick='return confirm("Ya existe una factura rectificativa de esta factura de alquiler, seguro que quieres crear otra?")' href="{{ route('facturas.convertRectificativa', $factura->id) }}">Rectificativa</a>
									@endif
								</td>
							</tr>

						@endif

					@endforeach

				</tbody>
			</table>

			{{ $facturasalquiler->appends(Request::except('page'))->links() }}

		</div><!-- End tab-pane -->

		@if( $facturasrectificativa != '' )

			<div class="tab-pane" id="docrectificativa">

				<table class="table table-hover tabla_lista_facturas">
					<thead>
						<tr>
							<td>
								Numero
							</td>
							<td>
								Cliente
							</td>
							<td>
								Fecha
							</td>
							<td>
								Total
							</td>
							@if( $active == 'facturas' )
							<td>
								Pagado
							</td>
						@endif
							<td>
								Operaciones
							</td>
						</tr>
					</thead>
					<tbody>

						@foreach( $facturasrectificativa as $factura )

							@if( ($factura->borrador == 0) && ($factura->presupuesto == 0) && ($factura->rectificativa == 1) && ($active == 'facturas') )
							
								<tr>
									<td>
										<a class="btn btn-default" href="{{ route('facturas.createlineshow', array($tipo, $factura->id)) }}">{{ 'RE '.substr($factura->fecha, 2, 2).'/'.$factura->num_factura }}</a>
									</td>
									<td>
										{{ HTML::linkRoute('facturas.show', e(Str::limit($factura->cliente->nombre, 30)), $factura->id, array( 'target' => '_blank' )) }}
									</td>
									<td>
										{{ substr($factura->fecha, 6, 2).'-'.substr($factura->fecha, 4, 2).'-'.substr($factura->fecha, 0, 4) }}
									</td>
									<td>
										{{ number_format((float)round($factura->total,2), 2, '.', '') }}
									</td>
									<td>
										@if( strlen($factura->fecha_pagado) == 8 )
											<i class="glyphicon glyphicon-ok"></i></a>
										@endif
									</td>
								</tr>

							@endif

						@endforeach

					</tbody>
				</table>

				{{ $facturasrectificativa->appends(Request::except('page'))->links() }}

			</div><!-- End tab-pane -->

		@endif

	</div><!--End tab-content -->

@stop