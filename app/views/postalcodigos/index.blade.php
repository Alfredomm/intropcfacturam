@extends('plantillas.default')

@section('header')

	@parent

	<h2 class="subtitol1">Listado de poblaciones</h2>
	@if( $errors->any() ) <br/> <div class="meserror subtitol1"> <h5> {{ $errors->first() }} </h5> </div> @endif

@stop

@section('content')
	
	<a class="btn btn-primary boto1" href="{{ route('postalcodigos.create') }}">Nueva Población</a>
	<!-- {{ HTML::linkRoute('postalcodigos.create', 'Nova població') }} -->

	<div class="row">

		<div class="col-md-4">

			{{ Form::open( array( 'method' => 'GET', 'route' => 'postalcodigos.filter' ) ) }}
			
				{{ Form::token() }}

				{{ Form::label('nombre', 'Buscar poblacion:') }}
				{{ Form::text('nombre', null, array( 'placeholder' => 'Todos...', 'autofocus' => true, 'class' => 'form-control campobusqueda1')) }}

				{{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-info botonbusqueda1')) }}

			{{ Form::close() }}

		</div><!-- End col-md-4 -->

	</div><!-- End row -->

	<table class="table table-hover tabla_lista_clientes">

		<thead>
			<tr>
				<td>
					Población
				</td>
				<td>
					Editar/Elimiar
				</td>
			</tr>
		</thead>
		<tbody>

			@foreach( $postalcodigos as $p )
			
				<tr>
					<td>
						{{ HTML::linkRoute('postalcodigos.show', e(Str::limit($p->poblacion, 50)), $p->id) }}
					</td>
					<td>
						<a class="btn btn-default" href="{{ route('postalcodigos.edit', $p->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
						{{ Form::open(array( 'route' => 'postalcodigos.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
							{{ Form::token() }}
							{{ Form::hidden('id', $p->id) }}
							{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Vas a borrar una población de tu base de datos, seguro que queires proceder?")')) }}
						{{ Form::close() }}
					</td>
				</tr>
			
			@endforeach

		</tbody>

	</table>

	{{ $postalcodigos->links() }}

@stop