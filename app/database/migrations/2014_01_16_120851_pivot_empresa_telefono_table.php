<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmpresaTelefonoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_telefono', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id')->unsigned()->index();
			$table->integer('telefono_id')->unsigned()->index();
			$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
		Schema::drop('empresa_telefono');
	}

}
