@extends('plantillas.default')
	
@section('content')
	
	<p>La seccion de clientes en la misma que se utiliza para empleados, la aplicacion te mostrara un listado de todos los clientes dados de alta por defecto, cuando accedas a dicha seccion de la aplicacion, asi a primera vista podremos hacer lo siguiente:</p>

	<p>
		<p><b>Nuevo cliente:</b>Desde aqui podras dar de alta un nuevo usuario</p>
		<p><b>Nota importante al dar de alta un cliente/empleado:</b>Si tenemos registrada ya la poblacion del cliente/empleado deberemos seleccionarla del desplegable y no ponerla de nuevo</p>
		<p><b>Nombre del cliente:</b>Si hacemos click en el nombre del cliente la aplicacion nosllevara a una seccion en la que apareceran todos los datos de nuestro cliente, estos pueden editarse o borrarse en cualquier momento</p>
		<p><b>Botones de editar y borrar:</b>Estos aparecer a menudo en muchos apartados de la aplicacion, es simple, el boton con el lapiz nos llevara a la edicion del cliente/empleado, y el boton borrar nos permitira borrar al cliente/empleado de la base de datos, despues de una confirmacion, es importante tener en cuenta que si el cliente tiene una factura a su nombre, este no podra borrarse hasta que no hayan sido borradas previamente todas las facturas a su nombre</p>
	</p>

@stop