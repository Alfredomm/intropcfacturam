<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	</head>
	<body>

		<div class="container">  

		    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                 
		        <div class="panel panel-info" >

		            <div class="panel-heading">
		                <div class="panel-title">Inicio de sesión</div>
		            </div><!-- End panel-heading -->   

		            <div style="padding-top:30px" class="panel-body" >

		                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
		                
		                {{ Form::open( array( 'method' => 'POST', 'class' => 'form-horizontal', 'route' => 'users.login' ) ) }}

						{{ Form::token() }}
		                            
		                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder'=>'Usuario', 'autofocus' => true)) }}                                       
		                    </div><!-- End input-group -->
		                        
		                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Contraseña')) }}
		                    </div><!-- End input-group -->
		                        
		                    <div class="input-group">
	                            <div class="checkbox">
	                                <label>
	                                  <input id="login-remember" type="checkbox" name="remember" value="1"> Recordar contraseña
	                                </label>
	                            </div>
	                        </div><!-- End input-group -->

	                        <div style="margin-top:10px" class="form-group">

	                            <div class="col-sm-12 controls">
	                              {{ Form::submit(('Entrar'), array('class'=>'btn btn-success boto2')) }}
	                            </div>

	                        </div><!-- End form-group -->

		                {{ Form::close() }}

		            </div><!-- End panel-body --> 

		        </div><!-- End panel panel-info -->

		    </div><!-- End mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 -->

		</div><!-- End container -->

	</body>
</html>