<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Task;
use App\StockItem;


class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
$fname = 'database/seeds/Order.csv';

$data = Excel::load($fname, function($reader){ })->get();

$data=$data->toArray();

foreach ($data as $key => $value)
{

      $item_id=StockItem::where('name',$value['skuid'])->pluck('id');    

 

if($value['qtyordered']> $value['qtyprinted']) //incomplete orders
{ 

 $order=Order::create([
      // CSV HEADERS SKUid,priority,qtyOrdered,qtyPrinted,id,SKU,ImpsOrdered,ImpsPrinted,Descr,dateOrdered,dateDue,notes
     'item_id'=> $item_id[0],
     'description'=> $value['descr'],
     'status'=>'Active',
     'date_order'=>$value['dateordered'],
     'date_due'=>($value['datedue']=='0000-00-00 00:00:00') ? NULL : $value['datedue'] , 
     'date_complete'=>($value['datedue']=='0000-00-00 00:00:00') ? NULL : $value['datedue'] ,
     'qty_order'=>$value['qtyordered'],
     'qty_complete'=> $value['qtyprinted'],
     'impressions'=> $value['imps'],
     'batch_size'=> $value['printstack'], //default for OrderSeeder
     'priority'=>  $value['priority'],
     'notes'=>  $value['notes']
    
    ]);

Task::create([
      'batch_number'=>($value['qtyprinted']/$value['printstack']+1),
      'order_id'=>$order->id,
      'action'=>'Print',
      'is_complete'=>'0',
      'progress'=>$value['qtyprinted'],
      'batch_size'=>$order->batch_size,
         ]);



}



else{

      Order::create([
        // CSV HEADERS SKUid,priority,qtyOrdered,qtyPrinted,id,SKU,ImpsOrdered,ImpsPrinted,Descr,dateOrdered,dateDue,notes
     'item_id'=> $item_id[0],
     'description'=> $value['descr'],
     'status'=>'Complete',
     'date_order'=>$value['dateordered'],
     'date_due'=>($value['datedue']=='0000-00-00 00:00:00') ? NULL : $value['datedue'] , 
     'date_complete'=>($value['datedue']=='0000-00-00 00:00:00') ? NULL : $value['datedue'] ,
     'qty_order'=>$value['qtyordered'],
     'qty_complete'=> $value['qtyprinted'],
     'impressions'=> $value['imps'],
     'batch_size'=> $value['printstack'], //default for OrderSeeder
     'priority'=>  $value['priority'],
     'notes'=>  $value['notes']
	
							]);


}








}






    }
}



