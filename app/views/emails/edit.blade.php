@extends('plantillas.default')

@section('header')

	@parent
	<h2 class="subtitol1">Editar email</h2>

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

			{{ Form::model($email, array( 'method' => 'PUT', 'route' => 'emails.update' ) ) }}
			
				{{ Form::token() }}

				{{ Form::hidden('id', $email->id) }}
				{{ Form::hidden('prevUrl', URL::previous()) }}
				

					<p>
						{{ Form::label('nombre', 'Nom') }}
						{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::label('email', 'Email') }}
						{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
					</p>

					<p>
						{{ Form::submit(('Guardar'),array('class'=>'btn btn-success')) }}
						
						{{ Form::reset(('Deshacer cambios'),array('class'=>'btn btn-default')) }}
					</p>

			{{ Form::close() }}

		</div><!-- End col-xs-4 -->
	
	</div><!-- End row -->

@stop