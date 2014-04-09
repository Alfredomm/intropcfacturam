<?php

class TiposivasTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('tiposivas')->truncate();

		$tiposivas = array(

			array(
				"tipo" => "Normal",
				"iva" => 21,
				"created_at" => new DateTime,
				"updated_at" => new DateTime
			)

		);

		// Uncomment the below to run the seeder
		DB::table('tiposivas')->insert($tiposivas);
	}

}
