<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotClienteTelefonoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_telefono', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->index();
			$table->integer('telefono_id')->unsigned()->index();
			$table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
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
		Schema::drop('cliente_telefono');
	}

}
