<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotClienteFaxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_fax', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->index();
			$table->integer('fax_id')->unsigned()->index();
			$table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
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
		Schema::drop('cliente_fax');
	}

}
