@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">{{ $empleado->nombre.' '.$empleado->apellido1.' '.$empleado->apellido2 }}</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empleados.index') }}">Listado de empleados</a>
	<!-- {{ HTML::linkRoute('empleados.index', 'Llista de empleados') }} -->

	<div class="botonex">

		<a class="btn btn-default" href="{{ route('empleados.edit', $empleado->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
		{{ Form::open(array( 'route' => 'empleados.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
			{{ Form::token() }}
			{{ Form::hidden('id', $empleado->id) }}
			{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un empleado de tu base da datos, seguro que queires proceder?")')) }}
		{{ Form::close() }}

	</div>

	<table class="table table-hover tabla_lista_empleados">
		<!-- La tabla_lista_empleados de la class no se molt be que fa... tampoc dona error ni res aixi que la dixe -->
		<tr>
			<td>Cif/Dni:</td><td>{{ $empleado->dni_cif }}</td>
		</tr>
		<tr>
			<td>Población:</td><td>{{ $empleado->postalcodigo->poblacion }}</td>
		</tr>
		<tr>
			<td>Dirección:</td><td>{{ $empleado->direccion }}</td>
		</tr>
		<tr>
			<td>Telefonos del empleado:</td>
			<td class="listst2">

				@foreach( $empleado->telefonos as $tlf )
					<ul>
						<li>{{ $tlf->nombre }}</li>
						<li>{{ $tlf->telefono }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
		<tr>
			<td>Emails del empleado:</td>
			<td class="listst2">

				@foreach( $empleado->emails as $email )
					<ul>
						<li>{{ $email->nombre }}</li>
						<li>{{ $email->email }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
		<tr>
			<td>Faxes del empleado:</td>
			<td class="listst2">

				@foreach( $empleado->faxs as $fax )
					<ul>
						<li>{{ $fax->nombre }}</li>
						<li>{{ $fax->fax }}</li>
					</ul> 
				@endforeach

			</td>
		</tr>
	</table>

@stop