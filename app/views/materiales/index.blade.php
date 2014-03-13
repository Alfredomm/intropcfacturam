@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Listado de materiales</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('materiales.create') }}">Nuevo material</a>
	<!-- {{ HTML::linkRoute('clientes.create', 'Nou client') }} este en teoria quedaria sustituit per el de dalt, pero mira que no haja liat res -->

	<div class="row">

		<div class="col-md-4">

			{{ Form::open( array( 'method' => 'GET', 'route' => 'materiales.filter' ) ) }}
			
				{{ Form::token() }}

				{{ Form::label('nombre', 'Buscar material:') }}
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

	@foreach( $materiales as $material )
		
		<tr>
			<td>
				{{ HTML::linkRoute('materiales.show', e(Str::limit($material->nombre, 50)), $material->id) }}
			</td>
			<td>
				<a class="btn btn-default" href="{{ route('materiales.edit', $material->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
				{{ Form::open(array( 'route' => 'materiales.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
					{{ Form::token() }}
					{{ Form::hidden('id', $material->id) }}
					{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar un material de tu base de datos, seguro que queires proceder?")')) }}
				{{ Form::close() }}
			</td>
		</tr>	

	@endforeach
	
	</tbody>
	</table>

	{{ $materiales->links() }}
	
@stop