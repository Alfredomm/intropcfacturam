<?php

class AjustesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('ajustes')->truncate();

		$ajustes = array(

			array(
				"iva" => 21,
				"created_at" => new DateTime,
				"updated_at" => new DateTime
			)

		);

		// Uncomment the below to run the seeder
		DB::table('ajustes')->insert($ajustes);
	}

}
