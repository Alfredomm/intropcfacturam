<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(

			"username" => 'admin',
			"password" => Hash::make('ipc*2014'),
			"created_at" => new DateTime,
			"updated_at" => new DateTime

		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
