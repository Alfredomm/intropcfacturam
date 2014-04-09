@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Tipos de iva</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('tiposiva.create') }}">Nuevo iva</a>

	<table class="table table-hover tabla_lista_clientes">
		<thead>
			<tr>
				<td>
					Nombre
				</td>
				<td>
					Porcentaje
				</td>
				<td>
					Editar/Eliminar
				</td>
			</tr>
		</thead>
		<tbody>

		@foreach( $tipoiva as $tiva )

			<tr>
				<td>
					{{ $tiva->tipo }}
				</td>
				<td>
					{{ $tiva->iva }}
				</td>
				<td>
					<a class="btn btn-default" href="{{ route('tiposiva.edit', $tiva->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
					{{ Form::open(array( 'route' => 'tiposiva.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
						{{ Form::token() }}
						{{ Form::hidden('id', $tiva->id) }}
						{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un tipo de iva de tu base de datos, seguro que queires proceder?")')) }}
					{{ Form::close() }}
				</td>
			</tr>

		@endforeach

		</tbody>
	</table>

@stop