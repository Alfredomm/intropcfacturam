@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">{{ $material->nombre }}</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('materiales.index') }}">Lista de materiales</a>
	<!-- {{ HTML::linkRoute('clientes.index', 'Llista de clientes') }} -->

	<div class="botonex">

		<a class="btn btn-default" href="{{ route('materiales.edit', $material->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
		{{ Form::open(array( 'route' => 'materiales.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $material->id) }}
			{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un material de tu base da datos, seguro que queires proceder?")')) }}
		{{ Form::close() }}

	</div><!-- End botonex -->

	<table class="table table-hover tabla_lista_clientes">
		<!-- La tabla_lista_clientes de la class no se molt be que fa... tampoc dona error ni res aixi que la dixe -->
		<tr>
			<td>Nombre:</td><td>{{ $material->nombre }}</td>
		</tr>
		<tr>
			<td>Cantidad:</td><td>{{ $material->cantidad }}</td>
		</tr>
		<tr>
			<td>Precio venta:</td><td>{{ $material->precio_venta }}</td>
		</tr>
		<tr>
			<td>Precio alquiler:</td><td>{{ $material->precio_alquiler }}</td>
		</tr>
	</table>

@stop