<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmailEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_empresa', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('email_id')->unsigned()->index();
			$table->integer('empresa_id')->unsigned()->index();
			$table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
			$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_empresa');
	}

}
