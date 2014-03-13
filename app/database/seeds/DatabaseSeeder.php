<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('EmpresasTableSeeder');
		// $this->call('EmpleadosTableSeeder');
		// $this->call('ClientesTableSeeder');
		// $this->call('TelefonosTableSeeder');
		// $this->call('FaxsTableSeeder');
		// $this->call('EmailsTableSeeder');
		// $this->call('PostalcodigosTableSeeder');
		// $this->call('TiposTableSeeder');
		// $this->call('PermisosTableSeeder');
		// $this->call('MaterialesTableSeeder');
		// $this->call('FacturalineasTableSeeder');
		// $this->call('FacturasTableSeeder');
		 $this->call('AjustesTableSeeder');
		 $this->call('UsersTableSeeder');
	}

}