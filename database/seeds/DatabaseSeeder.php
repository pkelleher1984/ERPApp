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
     echo(" -- DatabaseSeeder: run()");
     // $this->call(UsersTableSeeder::class);
       
      
      //REFERENCE TABLES
      $this->call(StockItemTypesTableSeeder::class);
      $this->call(BindingsTableSeeder::class);
      $this->call(FinishesTableSeeder::class);

      $this->call(UsersTableSeeder::class);

      //CORE TABLES
      
      $this->call(StockItemsTableSeeder::class); 
      //calls Books_table_seeder after. 
      //calls Orders_table_seeder after.(see StockItemsTableSeeder.php) 

}

}
