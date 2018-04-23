<?php

use Illuminate\Database\Seeder;

use App\StockItem;

class StockItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
*/
    
   
    public function run()
    {
        
        
$fname = 'database/seeds/SKU.csv';

$data = Excel::load($fname, function($reader){ })->get();

$data=$data->toArray();

foreach ($data as $key => $value)
{
    StockItem::create([

     'name'=> $value['skuid'],
     'desc'=> $value['name'],
     'ver'=>'x.x.x.x',
     'for_sale'=>TRUE,
     'active'=>TRUE,
     'prodType_id'=>2 //book 
   


        ]);
}
         $this->call(BooksTableSeeder::class); 
         $this->call(OrdersTableSeeder::class);
    }
        
       
    }

