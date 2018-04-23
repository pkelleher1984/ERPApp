<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\StockItem;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    
    public function run()
    {





//$fname = 'database/seeds/StockList2.csv';
$fname = 'database/seeds/SKU.csv';


$data = Excel::load($fname, function($reader){ })->get();


$data=$data->toArray();

foreach ($data as $key => $value)
{

     $item_id=StockItem::where('name',$value['skuid'])->pluck('id');    

      Book::create([

     'item_id'=> $item_id[0],
     'skuname'=> $value['skuid'],
     'active'=>TRUE,
     'duplex'=>FALSE,
     'binding_id'=>1, //coil
     'finish_id'=>1,
     'batch_size'=>$value['printstack'], //none
     'punch'=> 44,
     'impressions'=> $value['imps']
	
							]);
}
        
    }


}
