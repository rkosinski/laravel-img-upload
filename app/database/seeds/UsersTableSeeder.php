<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('users')->truncate();
        DB::table('users')->delete();

        $users = array(
            'email' => 'radek@blog.com',
            'username' => 'rdoe',
            'password' => Hash::make('radek'),
            'name' => 'Radek Doe',
            'url' => 'http://rkosinski.pl',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);

        $users = array(
            'email' => 'piotr@blog.com',
            'username' => 'piotr89',
            'password' => Hash::make('piotr'),
            'name' => 'Piotr Doe',
            'url' => 'http://piotr-doe.pl',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);

        $users = array(
            'email' => 'agata@blog.com',
            'username' => 'agaaaa',
            'password' => Hash::make('agata'),
            'name' => 'Agata Doe',
            'url' => 'http://agata.pl',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('users')->insert($users);
    }

}
