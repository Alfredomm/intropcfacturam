@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Listado de clientes</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('clientes.create') }}">Nuevo cliente</a>

	<div class="row">

		<div class="col-md-4">

			{{ Form::open( array( 'method' => 'GET', 'route' => 'clientes.filter' ) ) }}
			
				{{ Form::token() }}

				{{ Form::label('nombre', 'Buscar clientes:') }}
				{{ Form::text('nombre', null, array( 'placeholder' => 'Todos...', 'autofocus' => true, 'class' => 'form-control campobusqueda1')) }}

				{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info botonbusqueda1')) }}

			{{ Form::close() }}

		</div><!-- End col-md-4 -->

	</div><!-- End row -->

	<table class="table table-hover tabla_lista_clientes">
	<thead>
		<tr>
			<td>
				Numero
			</td>
			<td class="tabla-resumen-columna-cliente">
				Nombre
			</td>
			<td>
				Editar/Elimiar
			</td>
		</tr>
	</thead>
	<tbody>

	@foreach( $clientes as $cliente )
		
		<tr>
			<td>
				{{ $cliente->id }}
			</td>
			<td class="tabla-resumen-columna-cliente">
				{{ HTML::linkRoute('clientes.show',  e(Str::limit($cliente->nombre, 20)).' '.e(Str::limit($cliente->apellido1, 20)).' '.e(Str::limit($cliente->apellido2, 20)), $cliente->id) }}
			</td>
			<td>
				<a class="btn btn-default" href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
				{{ Form::open(array( 'route' => 'clientes.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
					{{ Form::token() }}
					{{ Form::hidden('id', $cliente->id) }}
					{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un cliente de tu base de datos, seguro que queires proceder?")')) }}
				{{ Form::close() }}
			</td>
		</tr>	

	@endforeach
	
	</tbody>
	</table>

	{{ $clientes->appends(Request::except('page'))->links() }}

@stop