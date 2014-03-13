@extends('plantillas.default')

@section('header')

	@parent
	
	<h2 class="subtitol1">Edicion de {{ $empresa->nombre.' - '.$empresa->direccion }} @if( $empresa->postalcodigo_id != 0 ) {{ - $empresa->postalcodigo->poblacion }} @endif</h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empresas.index') }}">Volver a la lista</a>
	<a class="btn btn-primary boto1" href="{{ route('empresas.contacts',$empresa->id) }}">Gestionar contactos</a>

	@if( $errors->has() )
		
		<div class="meserror">

			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombre', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif

	<div class="row">

	{{ Form::model($empresa, array( 'method' => 'PUT', 'route' => 'empresas.update' ) ) }}
	
		{{ Form::token() }}
		{{ Form::hidden('id', $empresa->id) }}

			<div class="col-md-6">

				<p>
					{{ Form::label('nombre', 'Nombre') }}
					{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('cif', 'Cif') }}
					{{ Form::text('cif', Input::old('cif'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('direccion', 'Direccion') }}
					{{ Form::text('direccion', Input::old('direccion'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('sitio_web', 'Sitio Web') }}
					{{ Form::text('sitio_web', Input::old('sitio_web'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('cuenta_corriente', 'Cuenta Corriente') }}
					{{ Form::text('cuenta_corriente', Input::old('cuenta_corriente'), array('class'=>'form-control')) }}
				</p>

				<p>
					{{ Form::label('postalcodigo_id', 'Poblaciones Lista') }}
					{{ Form::select('postalcodigo_id', $postalcodigo_id, Input::old('postalcodigo_id'), array('class'=>'form-control')) }}
				<p>
					{{ Form::submit(('Guardar'),array('class'=>'btn btn-success boto2')) }}
					
					{{ Form::reset(('Cancelar'),array('class'=>'btn btn-default boto2')) }}
				</p>

			</div><!-- End col-md-6 -->

	{{ Form::close() }}
	
	</div><!-- End row -->

@stop