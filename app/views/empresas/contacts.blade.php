@extends('plantillas.default')

@section('header')

	@parent

	<h2 class="subtitol1">Contactos de {{ $empresa->nombre.' - '.$empresa->direccion }} @if( count($empresa->postalcodigo) != 0 ) {{ ' - '.$empresa->postalcodigo->poblacion }} @endif </h2>

@stop

@section('content')

	<a class="btn btn-primary boto1" href="{{ route('empresas.show', $empresa->id) }}">Finalizar edicion</a>

		@if( $errors->has() )

		<div class="meserror">
				
			<p>
				Ha habido algunos errores:
			</p>

			<ul>
				{{ $errors->first('nombreFax', '<li>El campo nombre del fax es obligatorio</li>') }}
				{{ $errors->first('fax', '<li>:message</li>') }}

				{{ $errors->first('nombreEmail', '<li>El campo nombre del email es obligatorio</li>') }}
				{{ $errors->first('email', '<li>:message</li>') }}

				{{ $errors->first('nombreTlf', '<li>El campo nombre del telefono es obligatorio</li>') }}
				{{ $errors->first('telefono', '<li>:message</li>') }}
			</ul>

		</div><!-- End meserror -->

	@endif
	
	<div class="row">

		<div class="col-xs-4">

			{{ Form::open( array( 'method' => 'POST', 'route' => 'empresas.store' ) ) }}

				{{ Form::token() }}
				{{ Form::hidden('contacto', 'telefono') }}
				{{ Form::hidden('id', $empresa->id) }}

				<p>
					{{ Form::label('nombreTlf', 'Nombre') }}
					{{ Form::text('nombreTlf', Input::old('nombreTlf'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::label('telefono', 'Telefono') }}
					{{ Form::text('telefono', Input::old('telefono'), array('class' => 'form-control')) }}
				</p>

				<p>
					{{ Form::submit(('Guardar telefono'), array('class'=>'btn btn-success')) }}
				</p>

			{{ Form::close() }}

			<p><h3>Telefonos del empresa: </h3></p>

			<table class="table table-hover">

				@foreach( $empresa->telefonos as $tlf )

				<tr>

					<td><b><p class="prrfad" title="{{ $tlf->nombre }}">{{ e(Str::limit($tlf->nombre, 20)) }}</p></b><br><p class="prrfad" title="{{ $tlf->telefono }}">{{ e(Str::limit($tlf->telefono, 20)) }}</p></td>
					<td class="boto3">
						<a class="btn btn-default" href="{{ route('telefonos.edit', $tlf->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
						{{ Form::open(array( 'route' => 'telefonos.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
							{{ Form::token() }}
							{{ Form::hidden('id', $tlf->id) }}
							{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>

				</tr>

				@endforeach

			</table>

		</div><!-- end of col-xs-4 -->

	<div class="col-xs-4">

		{{ Form::open( array( 'method' => 'POST', 'route' => 'empresas.store' ) ) }}

			{{ Form::token() }}
			{{ Form::hidden('contacto', 'email') }}
			{{ Form::hidden('id', $empresa->id) }}

			<p>
				{{ Form::label('nombreEmail', 'Nombre') }}
				{{ Form::text('nombreEmail', Input::old('nombreEmail'), array('class' => 'form-control')) }}
			</p>

			<p>
				{{ Form::label('email', 'Email') }}
				{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
			</p>

			<p>
				{{ Form::submit(('Guardar email'), array('class' => 'btn btn-success')) }}
			</p>

		{{ Form::close() }}

		<p><h3>Emails del empresa: </h3></p>

		<table class="table table-hover">

				@foreach( $empresa->emails as $email )

				<tr>

					<td><b><p class="prrfad" title="{{ $email->nombre }}">{{ e(Str::limit($email->nombre, 20)) }}</p></b><br><p class="prrfad" title="{{ $email->email }}">{{ e(Str::limit($email->email, 20)) }}</p></td>
					<td class="boto3">
						<a class="btn btn-default" href="{{ route('emails.edit', $email->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
						{{ Form::open(array( 'route' => 'emails.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
							{{ Form::token() }}
							{{ Form::hidden('id', $email->id) }}
							{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>

				</tr>

				@endforeach

			</table>

	</div><!-- end of col-xs-4 -->

	<div class="col-xs-4">

		{{ Form::open( array( 'method' => 'POST', 'route' => 'empresas.store' ) ) }}

			{{ Form::token() }}
			{{ Form::hidden('contacto', 'fax') }}
			{{ Form::hidden('id', $empresa->id) }}

			<p>
				{{ Form::label('nombreFax', 'Nombre') }}
				{{ Form::text('nombreFax', Input::old('nombreFax'), array('class' => 'form-control')) }}
			</p>

			<p>
				{{ Form::label('fax', 'Fax') }}
				{{ Form::text('fax', Input::old('fax'), array('class' => 'form-control')) }}
			</p>

			<p>
				{{ Form::submit(('Guardar fax'), array('class' => 'btn btn-success')) }}
			</p>

		{{ Form::close() }}

		<p><h3>Faxes del empresa: </h3></p>

		<table class="table table-hover">

				@foreach( $empresa->faxs as $fax )

				<tr>

					<td><b><p class="prrfad" title="{{ $fax->nombre }}">{{ e(Str::limit($fax->nombre, 20)) }}</p></b><br><p class="prrfad" title="{{ $fax->fax }}">{{ e(Str::limit($fax->fax, 20)) }}</p></td>
					<td class="boto3">
						<a class="btn btn-default" href="{{ route('faxs.edit', $fax->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
						{{ Form::open(array( 'route' => 'faxs.destroy', 'method' => 'delete', 'class' => 'form_lista_clientes' )) }}
							{{ Form::token() }}
							{{ Form::hidden('id', $fax->id) }}
							{{ Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
						{{ Form::close() }}
					</td>

				</tr>

				@endforeach	

			</table>

		</div><!-- col-xs-4 -->

	</div><!-- End row -->

@stop