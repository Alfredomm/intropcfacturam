<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmpleadoFaxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empleado_fax', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empleado_id')->unsigned()->index();
			$table->integer('fax_id')->unsigned()->index();
			$table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
			$table->foreign('fax_id')->references('id')->on('faxs')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleado_fax');
	}

}
