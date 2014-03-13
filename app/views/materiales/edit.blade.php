@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar material</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('materiales.show',$material->id) }}">Volver al material</a>

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('categoria', '<li>:message</li>') }}
				{{ $errors->first('cantidad', '<li>:message</li>') }}
				{{ $errors->first('precio_venta', '<li>:message</li>') }}
				{{ $errors->first('precio_alquiler', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		{{ Form::model($material, array( 'method' => 'PUT', 'route' => 'materiales.update' ) ) }}
		
			{{ Form::token() }}

			{{ Form::hidden('id', $material->id) }}

			<div class="col-xs-6">

				<p>
					{{ Form::label('nombre', 'Nombre') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('categorias_lista', 'Categorias') }}
					{{ Form::select('categorias_lista', $categorias_lista, Input::old('categorias_lista'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('categoria', 'Categoria') }}
					{{ Form::text('categoria', Input::old('categoria'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('cantidad', 'Cantidad') }}
					{{ Form::text('cantidad', Input::old('cantidad'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('precio_venta', 'Precio Venta') }}
					{{ Form::text('precio_venta', Input::old('precio_venta'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('precio_alquiler', 'Precio Alquiler') }}
					{{ Form::text('precio_alquiler', Input::old('precio_alquiler'), array('class'=>'form-control')) }}
				</p>
					
				<p>
					{{ Form::submit(('Guardar cambios'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-xs-6 -->

		</div><!-- End row -->

	{{ Form::close() }}

@stop