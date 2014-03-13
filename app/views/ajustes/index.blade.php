@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar ajustes</h2>

@stop

@section('content')

	<table class="table table-hover tabla_lista_clientes">
		<thead>
			<tr>
				<td>
					Propiedad
				</td>
				<td>
					Editar
				</td>
			</tr>
		</thead>
		<tbody>
		<tr>
			<td>
				IVA
			</td>
			<td>
				<a class="btn btn-default" href="{{ route('ajustes.edit', $ajustes[0]->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
			</td>
		</tr>
		</tbody>
	</table>

@stop