@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">{{ $cliente->nombre.' '.$cliente->apellido1.' '.$cliente->apellido2 }}</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('clientes.index') }}">Lista de clientes</a>

	<div class="botonex">

		<a class="btn btn-default" href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
		{{ Form::open(array( 'route' => 'clientes.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $cliente->id) }}
			{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un cliente de tu base da datos, seguro que queires proceder?")')) }}
		{{ Form::close() }}

	</div><!-- End botonex -->

	<table class="table table-hover tabla_lista_clientes">
		<!-- La tabla_lista_clientes de la class no se molt be que fa... tampoc dona error ni res aixi que la dixe -->
		<tr>
			<td>Cif/Dni:</td><td>{{ $cliente->dni_cif }}</td>
		</tr>
		<tr>
			<td>Población:</td><td>{{ $cliente->postalcodigo->poblacion }}</td>
		</tr>
		<tr>
			<td>Dirección:</td><td>{{ $cliente->direccion }}</td>
		</tr>
		<tr>
			<td>Pagina web:</td><td>{{ HTML::link($cliente->sitio_web, $cliente->sitio_web, array('target' => '_blank')) }}</td>
		</tr>
		<tr>
			<td>Telefonos del cliente:</td>
			<td class="listst2">

				@foreach( $cliente->telefonos as $tlf )
					<ul>
						<li>{{ $tlf->nombre }}</li>
						<li>{{ $tlf->telefono }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
		<tr>
			<td>Emails del cliente:</td>
			<td class="listst2">

				@foreach( $cliente->emails as $email )
					<ul>
						<li>{{ $email->nombre }}</li>
						<li>{{ $email->email }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
		<tr>
			<td>Faxes del cliente:</td>
			<td class="listst2">

				@foreach( $cliente->faxs as $fax )
					<ul>
						<li>{{ $fax->nombre }}</li>
						<li>{{ $fax->fax }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
	</table>

@stop