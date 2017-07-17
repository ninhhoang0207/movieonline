<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
 }
 
class UsersTableSeeder extends Seeder {
	public function run()
	{
		DB::table('users')->insert([
			array('username'=>'admin','email'=>'admin@gmail.com','password'=>Hash::make(12345)),
			]);
			
	}

}
