@extends('plantillas.default')

@section('header')

	@parent

	<h2 class="subtitol1">{{ $postalcodigo->poblacion }}</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('postalcodigos.index') }}">Listado de poblaciones</a>
	<!-- {{ HTML::linkRoute('postalcodigos.index', 'Llistat de poblacions') }} -->

	<div class="botonex">

		<a class="btn btn-default" href="{{ route('postalcodigos.edit', $postalcodigo->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
		{{ Form::open(array( 'route' => 'postalcodigos.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $postalcodigo->id) }}
			{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar una población de tu base da datos, seguro que queires proceder?")')) }}
		{{ Form::close() }}

	</div><!-- End botonex -->

	<table class="table table-hover tabla_lista_clientes">
		<tr>
			<td>Población:</td><td>{{ $postalcodigo->poblacion }}</td>
		</tr>
		<tr>
			<td>Provincia:</td><td>{{ $postalcodigo->provincia }}</td>
		</tr>
		<tr>
			<td>Código postal:</td><td>{{ $postalcodigo->codigo_postal }}</td>
		</tr>
	</table>

@stop