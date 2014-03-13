@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Listado de empleados</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empleados.create') }}">Añadir empleado</a>
	<!-- {{ HTML::linkRoute('empleados.create', 'Nou client') }} este en teoria quedaria sustituit per el de dalt, pero mira que no haja liat res -->

	<div class="row">

		<div class="col-md-4">

			{{ Form::open( array( 'method' => 'GET', 'route' => 'empleados.filter' ) ) }}
			
				{{ Form::token() }}

				{{ Form::label('nombre', 'Buscar empleados:') }}
				{{ Form::text('nombre', null, array( 'placeholder' => 'Todos...', 'autofocus' => true, 'class' => 'form-control campobusqueda1')) }}

				{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info botonbusqueda1')) }}

			{{ Form::close() }}

		</div><!-- End col-md-4 -->

	</div><!-- End row -->

	<table class="table table-hover tabla_lista_clientes">
	<thead>
		<tr>
			<td>
				Nombre
			</td>
			<td>
				Editar/Elimiar
			</td>
		</tr>
	</thead>
	<tbody>

	@foreach( $empleados as $empleado )
		
		<tr>
			<td>
				{{ HTML::linkRoute('empleados.show', e(Str::limit($empleado->nombre, 10)).' '.e(Str::limit($empleado->apellido1, 10)).' '.e(Str::limit($empleado->apellido2, 10)), $empleado->id) }}
			</td>
			<td>
				<a class="btn btn-default" href="{{ route('empleados.edit', $empleado->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
				{{ Form::open(array( 'route' => 'empleados.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
					{{ Form::token() }}
					{{ Form::hidden('id', $empleado->id) }}
					{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un empleado de tu base de datos, seguro que queires proceder?")')) }}
				{{ Form::close() }}
			</td>
		</tr>	

	@endforeach
	
	</tbody>
	</table>

	{{ $empleados->appends(Request::except('page'))->links() }}

@stop