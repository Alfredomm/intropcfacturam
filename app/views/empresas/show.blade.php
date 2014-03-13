@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">{{ $empresa->nombre }}</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empresas.index') }}">Lista de empresas</a>

	<div class="botonex">

		<a class="btn btn-default" href="{{ route('empresas.edit', $empresa->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
		{{ Form::open(array( 'route' => 'empresas.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $empresa->id) }}
			{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar una entidad de tu base da datos, seguro que queires proceder?")')) }}
		{{ Form::close() }}

	</div><!-- End botonex -->

	<table class="table table-hover tabla_lista_clientes">
		<!-- La tabla_lista_clientes de la class no se molt be que fa... tampoc dona error ni res aixi que la dixe -->
		<tr>
			<td>Nombre:</td><td>{{ $empresa->nombre }}</td>
		</tr>
		<tr>
			<td>Dirección:</td><td>{{ $empresa->direccion }}</td>
		</tr>
		<tr>
			<td>Población:</td><td> @if( $empresa->postalcodigo_id != 0 ) {{ $empresa->postalcodigo->poblacion }} @endif </td>
		</tr>
		<tr>
			<td>Cif:</td><td>{{ $empresa->cif }}</td>
		</tr>
		<tr>
			<td>Cuenta corriente:</td><td>{{ $empresa->cuenta_corriente }}</td>
		</tr>
	</table>

@stop