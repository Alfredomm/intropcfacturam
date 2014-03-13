<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmailEmpleadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_empleado', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('email_id')->unsigned()->index();
			$table->integer('empleado_id')->unsigned()->index();
			$table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
			$table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_empleado');
	}

}
