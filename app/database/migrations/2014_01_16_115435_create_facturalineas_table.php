<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturalineasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturalineas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('material_id');
			$table->string('nombre');
			$table->integer('factura_id');
			$table->decimal('cantidad_material');
			$table->decimal('dias');
			$table->decimal('precio');
			$table->decimal('iva');
			$table->decimal('descuento');
			$table->decimal('subtotal');
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
		Schema::drop('facturalineas');
	}

}
