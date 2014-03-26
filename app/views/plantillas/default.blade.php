<!DOCTYPE html>
<html ng-app='plunker'>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Facturas</title>
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/style.css') }}

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>

		<div class="tot">

			<header class="header1">

				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#audionet-navbar-main">
								<span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
								<span class="sr-only">Toggle navigation</span>
							</button>
							<a class="navbar-brand" href="#">Empresa</a>
						</div><!-- end of navbar-header -->
						<div class="collapse navbar-collapse espacio" id="audionet-navbar-main">
							<ul class="nav navbar-nav">

								@if( $active == 'clientes' )
									<li class="active"><a href="{{ route('clientes.index') }}"><span class="glyphicon glyphicon-briefcase"></span> Clientes</a></li>
								@else
									<li><a href="{{ route('clientes.index') }}"><span class="glyphicon glyphicon-briefcase"></span> Clientes</a></li>
								@endif

								@if( $active == 'empleados' )
									<li class="active"><a href="{{ route('empleados.index') }}"><span class="glyphicon glyphicon-user"></span> Empleados</a></li>
								@else
									<li><a href="{{ route('empleados.index') }}"><span class="glyphicon glyphicon-user"></span> Empleados</a></li>
								@endif

								@if( $active == 'facturas' || $active == 'presupuestos' || $active == 'borradores' )
									<li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Documentos <b class="caret"></b></a>
								@else
									<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Documentos <b class="caret"></b></a>
								@endif

									<ul class="dropdown-menu">
										@if( $active == 'facturas' )
											<li class="active"><a href="{{ route('facturas.tipodoc', 'facturas') }}"><span class="glyphicon glyphicon-list-alt"></span> Facturas</a></li>
										@else
											<li><a href="{{ route('facturas.tipodoc', 'facturas') }}"><span class="glyphicon glyphicon-list-alt"></span> Facturas</a></li>
										@endif

										@if( $active == 'presupuestos' )
											<li class="active"><a href="{{ route('facturas.tipodoc', 'presupuestos') }}"><span class="glyphicon glyphicon-list-alt"></span> Presupuestos</a></li>
										@else
											<li><a href="{{ route('facturas.tipodoc', 'presupuestos') }}"><span class="glyphicon glyphicon-list-alt"></span> Presupuestos</a></li>
										@endif

										@if( $active == 'borradores' )
											<li class="active"><a href="{{ route('facturas.tipodoc', 'borradores') }}"><span class="glyphicon glyphicon-list-alt"></span> Borradores</a></li>
										@else
											<li><a href="{{ route('facturas.tipodoc', 'borradores') }}"><span class="glyphicon glyphicon-list-alt"></span> Borradores</a></li>
										@endif
							        </ul>

								</li>

								@if( $active == 'postalcodigos' )
									<li class="active"><a href="{{ route('postalcodigos.index') }}"><span class="glyphicon glyphicon-globe"></span> Poblaciones</a></li>
								@else
									<li><a href="{{ route('postalcodigos.index') }}"><span class="glyphicon glyphicon-globe"></span> Poblaciones</a></li>
								@endif

								@if( $active == 'materiales' )
									<li class="active"><a href="{{ route('materiales.index') }}"><span class="glyphicon glyphicon-credit-card"></span> Materiales</a></li>
								@else
									<li><a href="{{ route('materiales.index') }}"><span class="glyphicon glyphicon-credit-card"></span> Materiales</a></li>
								@endif

								@if( $active == 'ajustes' )
									<li class="active"><a href="{{ route('ajustes.index') }}"><span class="glyphicon glyphicon-cog"></span> Ajustes</a></li>
								@else
									<li><a href="{{ route('ajustes.index') }}"><span class="glyphicon glyphicon-cog"></span> Ajustes</a></li>
								@endif

								@if( $active == 'empresas' )
									<li class="active"><a href="{{ route('empresas.index') }}"><span class="glyphicon glyphicon-list"></span> Datos de empresa</a></li>
								@else
									<li><a href="{{ route('empresas.index') }}"><span class="glyphicon glyphicon-list"></span> Datos de empresa</a></li>
								@endif

								@if( $active == 'resumen' )
									<li class="active"><a href="{{ route('facturas.resumen') }}"><span class="glyphicon glyphicon-signal"></span> Resumen anual</a></li>
								@else
									<li><a href="{{ route('facturas.resumen') }}"><span class="glyphicon glyphicon-signal"></span> Resumen anual</a></li>
								@endif

								@if( $active == 'logout' )
									<li class="active"><a href="{{ route('users.logout') }}"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
								@else
									<li><a href="{{ route('users.logout') }}"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
								@endif
								
							</ul>
						</div>
					</div><!-- end of container-fluid -->
				</nav>

				@section('header')

				<h1 class="titol1">Gestión de empresa</h1>

				@show

			</header><!-- End header1 -->

			<main class="container1">

					@yield('content')		

			</main><!-- End container1 -->

			<footer class="footer1">
				<p class="introm">&copy;IntroPC <span class="footer-text">Built with <a href="http://laravel.com" target="_blank" data-toggle="tooltip" data-placement="top" title="Laravel4 php framework"><img src="/img/laravel4-icono.png" class="laravel-icono"></a> - Designed with <a href="http://getbootstrap.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="Twitter Bootstrap"><img src="/img/bootstrap-icono.png" class="bootstrap-icono"></a> - Mantained with <a href="http://github.com" target="_blank" data-toggle="tooltip" data-placement="top" title="GitHub control version"><img src="/img/github-icono.png" class="git-icono"></a> - Hosted on <a href="http://http://aws.amazon.com/" target="_blank" data-toggle="tooltip" data-placement="top" title="amazon ec2 cloud hosting"><img src="/img/Amazon-Cloud-Computing-Logo.png" class="amazon-icono"></a></span></p>
			</footer>

		</div><!-- End tot -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		{{ HTML::script('https://code.jquery.com/jquery.js') }}
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    {{ HTML::script('js/bootstrap.min.js') }}
	    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js') }}
	    {{ HTML::script('js/ui-bootstrap-tpls-0.10.0.min.js') }}

	    @yield('script')

	    <script>
	    	(function(){
	    		$('a').tooltip();
	    	})();
	    </script>

	</body>
</html>