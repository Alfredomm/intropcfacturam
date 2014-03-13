<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmpleadoTelefonoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empleado_telefono', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empleado_id')->unsigned()->index();
			$table->integer('telefono_id')->unsigned()->index();
			$table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
			$table->foreign('telefono_id')->references('id')->on('telefonos')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleado_telefono');
	}

}
