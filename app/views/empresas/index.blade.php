@extends('plantillas.default')

@section('header')

	@parent

	<h2 class="subtitol1">Entidades</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empresas.create') }}">Nueva entidad</a>

	@foreach ($empresas as $empresa)
		<ul>
			<li>{{ HTML::linkRoute( 'empresas.show', $empresa->nombre, $empresa->id ) }} - {{ $empresa->direccion }} @if( $empresa->postalcodigo_id != 0 ) {{ - $empresa->postalcodigo->poblacion }} @endif</li>
		</ul>
	@endforeach
	
@stop