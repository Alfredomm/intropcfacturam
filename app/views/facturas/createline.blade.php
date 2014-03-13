@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Creación de {{ $tipo }} ( para 
		@if( $factura->venta == 0 )
		{{ 'alquiler' }}
		@else
		{{ 'venta' }}
		@endif
		)</h2>

@stop

@section('content')
	<?php $viewValue = "a"; ?>
	<a class="btn btn-primary boto1" href="{{ route('facturas.tipodoc', $tipo) }}">Lista de {{ $tipo }}</a>
	@if( ($tipo == 'borradores') || ($tipo == 'presupuestos') )
	<a class="btn btn-primary boto1" href="{{ route('facturas.convert', $factura->id) }}">Convertir a factura</a>
	@endif

	@if( $tipo == 'facturas' )
		<a class="btn btn-primary boto1" href="{{ route('facturas.duplicate', array($factura->id, $tipo)) }}">Duplicar factura</a>
	@elseif( $tipo == 'presupuestos' )
		<a class="btn btn-primary boto1" href="{{ route('facturas.duplicate', array($factura->id, $tipo)) }}">Duplicar presupuesto</a>
	@endif

	@if( $errors->has() )
		
		<div class="meserror">

			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('referncia', '<li>:message</li>') }}
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('cantidad_material', '<li>:message</li>') }}
				{{ $errors->first('precio', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		<h4>
			Fecha de emisión de la factura:
		</h4>

		{{ Form::open(array('method' => 'PUT', 'route' => 'facturas.update')) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $factura->id) }}
			{{ Form::hidden('tipo', $tipo) }}
			{{ Form::hidden('update', 'fecha_emision') }}
		<div class="col-md-2">
			<p class="form-group">
				{{ Form::label('dia', 'Dia') }}
				{{ Form::select('dia', $dias, substr($factura->fecha, 6, 2), array('class' => 'form-control')) }}
			</p>
		</div>
		<div class="col-md-3">
			<p class="form-group">
				{{ Form::label('mes', 'Mes') }}
				{{ Form::select('mes', $meses, substr($factura->fecha, 4, 2), array('class' => 'form-control')) }}
			</p>
		</div>
		<div class="col-md-2">
			<p class="form-group">
				{{ Form::label('anyo', 'Año') }}
				{{ Form::select('anyo', $anyos, substr($factura->fecha, 0, 4), array('class' => 'form-control')) }}
			</p>
		</div>
		<div class="clo-md-2">
			<p class="form-group">
				{{ Form::submit(('Actualizar fecha'),array('class'=>'btn btn-info form-submits')) }}
			</p>
		</div>
		{{ Form::close() }}
	</div><!-- end of row -->

	<div class="row">

		{{ Form::open(array('method' => 'PUT', 'route' => 'facturas.update')) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $factura->id) }}
			{{ Form::hidden('tipo', $tipo) }}
			{{ Form::hidden('update', 'fecha_pagado') }}

		<h4>
			Fecha de pago de la factura:

			@if( strlen($factura->fecha_pagado) == 8 )

		</h4>
				<div class="col-md-2">
					<p class="form-group">
						{{ Form::label('dia', 'Dia') }}
						{{ Form::select('dia', $dias, substr($factura->fecha_pagado, 6, 2), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="col-md-3">
					<p class="form-group">
						{{ Form::label('mes', 'Mes') }}
						{{ Form::select('mes', $meses, substr($factura->fecha_pagado, 4, 2), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="col-md-2">
					<p class="form-group">
						{{ Form::label('anyo', 'Año') }}
						{{ Form::select('anyo', $anyos, substr($factura->fecha_pagado, 0, 4), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="col-md-2">
					<p class="form-group">
						{{ Form::submit(('Fecha pago'),array('class'=>'btn btn-info form-submits')) }}
					</p>
				</div>
				{{ Form::close() }}
				<div class="col-md-2 borrar-pagado">
					<p class="form-group">
						{{ Form::open(array( 'route' => 'facturas.update', 'method' => 'PUT')) }}
							{{ Form::token() }}
							{{ Form::hidden('id', $factura->id) }}
							{{ Form::hidden('tipo', $tipo) }}
							{{ Form::hidden('update', 'borrar_fecha_pagado') }}
							{{ Form::button('Deshacer fecha de pago', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</p>
				</div>
			@else
		<span class="no-pagado">( Por el momento no hay fecha de pago )</span>
		</h4>
				<div class="col-md-2">
					<p class="form-group">
						{{ Form::label('dia', 'Dia') }}
						{{ Form::select('dia', $dias, substr($factura->fecha, 6, 2), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="col-md-3">
					<p class="form-group">
						{{ Form::label('mes', 'Mes') }}
						{{ Form::select('mes', $meses, substr($factura->fecha, 4, 2), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="col-md-2">
					<p class="form-group">
						{{ Form::label('anyo', 'Año') }}
						{{ Form::select('anyo', $anyos, substr($factura->fecha, 0, 4), array('class' => 'form-control')) }}
					</p>
				</div>
				<div class="clo-md-2">
					<p class="form-group">
						{{ Form::submit(('Fecha pago'),array('class'=>'btn btn-info form-submits')) }}
					</p>
				</div>
				{{ Form::close() }}
			@endif
	</div><!-- end of row -->

	<div class="row">

		<div class="row fila1" id="nombremat_html">

			<div class="col-md-6">

			{{ Form::open(array( 'method' => 'POST', 'route' => 'facturas.refreshmaterial' ) ) }}

				{{ Form::token() }}
				{{ Form::hidden('factura_id', $factura->id) }}
				{{ Form::hidden('tipo', $tipo) }}

					<p>
						{{ Form::label('nombre', 'Material') }}
						{{ Form::select('nombre', $material, Input::old('nombre'), array('class'=>'form-control')) }}
					</p>

				</div><!-- End col-md-6 -->

				<div class="col-md-2">

					<p>
						{{ Form::button('<i class="glyphicon glyphicon-refresh"></i>', array('type' => 'submit', 'class' => 'btn btn-info ico1')) }}
					</p>

				</div><!-- End col-md-2 -->

		</div><!-- End row -->

		<div class="row fila1 hide" id="nombremat_angjs">

			<div class="col-md-6">	

				<div ng-controller="list" class="container-fluid">
					<p>
						{{ Form::label('nombremat', 'Material') }}
						{{ Form::text('nombremat', null, array('class'=>'form-control', 'ng-model'=>'asyncSelected', 'typeahead' => "material as (material.categoria+' '+material.nombre) for material in materialjs($viewValue)", 'typeahead-loading' => "cargandoMateriales", 'autocomplete' => 'off')) }}
						<i ng-show="cargandoMateriales" class="glyphicon glyphicon-refresh cargandoMat"></i>
						<input type="hidden" value=@{{asyncSelected.id}} name="nombreMat_id" id="nombreMat_id" />
					</p>

				</div><!-- End ng-controller list -->

				</div><!-- End col-md-6 -->

				<div class="col-md-2">

					<p>
						{{ Form::button('<i class="glyphicon glyphicon-refresh"></i>', array('type' => 'submit', 'class' => 'btn btn-info ico1')) }}
					</p>

				</div><!-- End col-md-2 -->

			{{ Form::close() }}

		</div><!-- End row -->

		<div class="row fila1">

			@if( isset($mat) )
	
			{{ Form::model($mat, array( 'method' => 'POST', 'route' => 'facturas.addline' ) ) }}
			{{ Form::hidden('material_id', $mat->id) }}
	
			@else
	
			{{ Form::open(array( 'method' => 'POST', 'route' => 'facturas.addline' ) ) }}
	
			@endif
			
			{{ Form::token() }}
			{{ Form::hidden('factura_id', $factura->id) }}
			{{ Form::hidden('tipo', $tipo) }}

			@if( $factura->venta == 1 )

				{{ Form::hidden('dias', 1) }}

			@endif

			<div class="col-md-7">

				<p>
					{{ Form::label('nombre', 'Descripcion') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class'=>'form-control')) }}
				</p>

			</div><!-- End col-md-7 -->

			<div class="col-md-1">

				<p>
					{{ Form::label('cantidad_material', 'Ud.') }}
					{{ Form::text('cantidad_material', Input::old('cantidad_material'), array('class'=>'form-control')) }}
				</p>

			</div><!-- End col-md-1 -->

			@if( $factura->venta == 0 )

			<div class="col-md-1">

				<p>
					{{ Form::label('dias', 'Dias') }}
					{{ Form::text('dias', Input::old('dias'), array('class'=>'form-control')) }}
				</p>

			</div><!-- End col-md-1 -->

			@endif

			<div class="col-md-2">

				<p>
					@if( $factura->venta == 1 )
						{{ Form::label('precio_venta', 'Precio Ud.') }}
						{{ Form::text('precio_venta', Input::old('precio'), array('class'=>'form-control')) }}
					@else
						{{ Form::label('precio_alquiler', 'Precio Ud.') }}
						{{ Form::text('precio_alquiler', Input::old('precio'), array('class'=>'form-control')) }}
					@endif
				</p>

			</div><!-- End col-md-2 -->

			<div class="col-md-1">

				<p>
					{{ Form::label('descuento', 'Dto.') }}
					{{ Form::text('descuento', Input::old('descuento'), array('class'=>'form-control')) }}
				</p>

			</div><!-- End col-md-1 -->
		
		</div><!-- End row -->

		<div class="row fila1">

			<div class="col-md-4">

				<p>
					{{ Form::submit(('Añadir linea'),array('class'=>'btn btn-info boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-md-4 -->

		</div><!-- End row -->

		{{ Form::close() }}

		@if( isset($factura) )
			<div class="lineasfactura1">
				<table class="table table-hover">
							<tr>
								<th>Descripcion:</th>
								<th>Unidades:</th>
								@if( $factura->venta != 1 )
									<th>Dias:</th>
								@endif
								<th>Precio:</th>
								<th>Descuento:</th>
								<th>SUB-TOTAL:</th>
								<th></th>
							</tr>
					<?php $suma = 0; ?>
					@foreach( $factura->facturalineas as $fl )
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
								@if( $factura->venta != 1 )
									<td>
										@if( $fl->dias != 0 )
											{{$fl->dias}}
										@endif
									</td>
								@endif
								<td>
									@if( $fl->precio != 0 )
										{{$fl->precio}}
									@endif
								</td>
								<td>
									@if( $fl->descuento != 0 )
										{{$fl->descuento}}%
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
								<td>
									{{ Form::open(array( 'route' => 'facturalineas.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
										{{ Form::token() }}
										{{ Form::hidden('id', $fl->id) }}
										{{ Form::hidden('tipo', $tipo) }}
										{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
									{{ Form::close() }}
								</td>	
							</tr>	
					@endforeach
				</table>
				<table border="1" class="resultadot">
					<tr>
						<th>Base imponible:</th><th>IVA:</th><th>TOTAL:</th>
					</tr>
					<tr>
						<td>{{ $suma }}</td><td>{{ $ajustes->iva }}%</td><td>{{ round($suma + ($suma * (($ajustes->iva)/100)), 2) }}</td>
					</tr>
				</table>
			</div><!-- End lineasfactura1 -->
		@endif

		{{ Form::model($factura, array( 'method' => 'GET', 'route' => 'facturas.show', 'target' => '_blank' ) ) }}

			{{ Form::token() }}

			{{ Form::hidden('factura_id', $factura->id) }}

			<div class="row fila2">

				<div class="col-md-2">
					<p>
						{{ Form::label('direccion2', 'Segunda direccion de empresa') }}
						{{ Form::checkbox('direccion2') }}
					</p>
				</div>

				<div class="col-md-7">

					<p>
						{{ Form::label('observaciones', 'Observaciones:') }}
						{{ Form::text('observaciones', Input::old('observaciones'), array('class'=>'form-control')) }}
					</p>

				</div><!-- End col-md-7 -->

			</div><!-- End row -->

			<p>
				{{ Form::submit(('Finalizar entrada de lineas'),array('class'=>'btn btn-success boto4')) }}
			</p>

		{{ Form::close() }}

	</div><!-- End row -->

@stop

@section('script')

	<script>
		angular.module('plunker', ['ui.bootstrap'])
		.controller('list', function($scope, $http, $filter) {

			angular.element('#nombremat_html').addClass('hide');
			angular.element('#nombremat_angjs').removeClass('hide');
			angular.element('#nombreMat_id').val('');

			$scope.selected = undefined;

			$scope.materialjs = function() {
			    return $http.post('/facturas/listamateriales')
			    .then(function(res){
			      var materiales = [];
			      angular.forEach(res.data.materialjs, function(material){
			      	//$filter('filter')(material.categoria, $scope.asyncSelected);
			        materiales.push(material);
			      });
			      materiales = $filter('filter')(materiales, {nombreCat: $scope.asyncSelected});
			      return materiales;
			    });
		  	};
		});

	</script>

@stop