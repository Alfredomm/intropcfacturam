@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar fax</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ URL::previous() }}">Volver</a>

	@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Hi ha hagut alguns errors:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
				{{ $errors->first('apellido1', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

		<div class="col-xs-4">

		{{ Form::model($fax, array( 'method' => 'PUT', 'route' => 'faxs.update' ) ) }}
		
			{{ Form::token() }}

			{{ Form::hidden('id', $fax->id) }}
			{{ Form::hidden('prevUrl', URL::previous()) }}

				<p>
					{{ Form::label('nombre', 'Nom') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('fax', 'Fax') }}
					{{ Form::text('fax', Input::old('fax'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::submit(('Guardar'),array('class'=>'btn btn-success')) }}
					
					{{ Form::reset(('Deshacer cambios'),array('class'=>'btn btn-default')) }}
				</p>

			</div><!-- End col-xs-4 -->

		</div><!-- End row -->

	{{ Form::close() }}

@stop