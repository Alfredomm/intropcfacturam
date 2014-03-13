<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('num_factura');
			$table->integer('cliente_id');
			$table->string('fecha', 8);
			$table->boolean('venta');
			$table->boolean('presupuesto');
			$table->boolean('rectificativa');
			$table->boolean('existe_rectificativa');
			$table->boolean('borrador');
			$table->boolean('direccion2');
			$table->decimal('total');
			$table->string('observaciones');
			$table->string('fecha_pagado', 8);
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
		Schema::drop('facturas');
	}

}
