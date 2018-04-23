<?php
use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {





$fname = 'database/seeds/UserList.csv';


$data = Excel::load($fname, function($reader){ })->get();


$data=$data->toArray();

foreach ($data as $key => $value)
{


      User::create([

     'name'=> $value['name'],
     'email'=> $value['email'],
     'admin'=> $value['admin'],
     'password'=> $value['password'],
     'remember_token'=> $value['remember_token']
	
							]);
}
        
    }
}
