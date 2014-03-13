<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmpresaFaxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_fax', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id')->unsigned()->index();
			$table->integer('fax_id')->unsigned()->index();
			$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
		Schema::drop('empresa_fax');
	}

}
