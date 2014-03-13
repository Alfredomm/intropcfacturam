<?php

class EmpresasTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('empresas')->delete();

		$empresas = array(
			array(
				"nombre" => "Audio-Net Alquiler Professional S.L.",
				"cif" => "B97555783",
				"sitio_web" => "http://www.audio-net.es",
				"direccion" => "Pol. Industrial Xara, C/ Foia 4",
				"created_at" => new DateTime,
				"updated_at" => new DateTime
			)
		);

		// Uncomment the below to run the seeder
		DB::table('empresas')->insert($empresas);
	}

}
