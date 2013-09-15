<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
        DB::table('users')->truncate();
        DB::table('users')->delete();

        $users = array(
            'email' => 'radek@blog.com',
            'password' => Hash::make('radek'),
            'name' => 'Radek Doe',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);

        $users = array(
            'email' => 'piotr@blog.com',
            'password' => Hash::make('piotr'),
            'name' => 'Piotr Doe',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);

        $users = array(
            'email' => 'agata@blog.com',
            'password' => Hash::make('agata'),
            'name' => 'Agata Doe',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);
	}

}
