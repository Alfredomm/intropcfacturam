@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Creación de {{ $tipo }}</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('facturas.tipodoc', $tipo) }}">Listado de {{ $tipo }}</a>

	@if( isset($_GET['error']) )
		
		<div class="meserror">

			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				<li>{{ $_GET['error'] }}</li>
			</ul>

		</div><!-- End meserror -->

	@endif
	
	<?php $viewValue = ''; ?>

	<div class="row">

		<div class="col-md-6">

			{{ Form::open( array( 'method' => 'POST', 'route' => 'facturas.verification' ) ) }}
			
				{{ Form::token() }}
				{{ Form::hidden('tipo', $tipo) }}

					<p>Busca un cliente, o selecciona uno de la lista:</p>

					<div ng-controller="list" class="container-fluid" id="nombremat_angjs">

						<h3>Cliente nº: @{{asyncSelected.id}}</h3>

						<p>
							{{ Form::label('nombreCli', 'Cliente') }}
							{{ Form::text('nombreCli', null, array('class'=>'form-control', 'autofocus' => true, 'ng-model'=>'asyncSelected', 'typeahead' => "cliente as (cliente.nombre+' '+cliente.apellido1+' '+cliente.apellido2) for cliente in clientejs($viewValue)", 'typeahead-loading' => "cargandoClientes", 'autocomplete' => 'off', 'ng-trim' => false)) }}
							<i ng-show="cargandoClientes" class="glyphicon glyphicon-refresh cargandoMat"></i>
							<input type="hidden" value=@{{asyncSelected.id}} name="nombreCli_id" id="nombreCli_id" />
						</p>
					</div>
					
					<div id="nombremat_html">
						<p>
							{{ Form::label('nombre', 'Cliente') }}
							{{ Form::select('nombre', $cliente, Input::old('nombre'), array('class'=>'form-control')) }}
						</p>
					</div>
					

					<div class="tipodoc">

						<p>
							{{ Form::label('tipologia', 'Venta') }}
							{{ Form::radio('tipologia', 'venta') }}
						</p>

						<p>
							{{ Form::label('tipologia', 'Alquiler') }}
							{{ Form::radio('tipologia', 'alquiler') }}
						</p>

					</div><!-- End tipodoc -->
						
					<p>
						{{ Form::submit(('Continuar'),array('class'=>'btn btn-success boto2')) }}
						
						{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
					</p>

			{{ Form::close() }}

		</div><!-- End col-md-6 -->
	
	</div><!-- End row -->

@stop

@section('script')

	<script>
		angular.module('plunker', ['ui.bootstrap'])
		.controller('list', function($scope, $http, $filter) {

			angular.element('#nombremat_html').addClass('hide');
			angular.element('#nombremat_angjs').removeClass('hide');
			angular.element('#nombreCli_id').val('');

			$scope.selected = undefined;

			$scope.clientejs = function() {
			    return $http.post('/facturas/listaclientes')
			    .then(function(res){
			      var clientes = [];
			      angular.forEach(res.data.clientejs, function(cliente){
			      	//$filter('filter')(material.categoria, $scope.asyncSelected);
			        clientes.push(cliente);
			      });
			      clientes = $filter('filter')(clientes, {nombreCompleto: $scope.asyncSelected});
			      return clientes;
			    });
		  	};
		});

	</script>

@stop