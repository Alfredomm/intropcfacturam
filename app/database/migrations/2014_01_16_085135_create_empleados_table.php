<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpleadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empleados', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre');
			$table->string('apellido1');
			$table->string('apellido2');
			$table->string('direccion');
			$table->string('dni');
			$table->integer('postalcodigo_id');
			$table->string('cuenta_corriente');
			$table->string('tipo', 2);
			$table->string('permisos', 2);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleados');
	}

}
