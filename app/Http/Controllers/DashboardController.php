<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Task;
use App\LogEntry;
use App\StockItem;


use DB;

class DashboardController extends Controller
{
    

   public function metrics()

   {


		   $sum_stats['planned']=Order::where('status','=','Planned')->select(DB::raw('sum(impressions * qty_order) as total'))->pluck('total')->toArray();
           
           $sum_stats['active_ordered']=Order::where('status','=','Active')->select(DB::raw('sum(impressions * qty_order) as total'))->pluck('total')->toArray() ;
           
           $sum_stats['active_complete']=Order::where('status','=','Active')->select(DB::raw('sum(impressions * qty_complete) as total'))->pluck('total')->toArray() ;
           


			$sum_stats['discs_planned']=Order::where('status','=','Planned')->whereHas('stockItem',function($query){$query->where('prodType_id','=','3');})->sum('qty_order');
			$sum_stats['combos_planned']=Order::whereHas('stockItem',function($query){$query->where('prodType_id','=','4');})->where('status','=','Planned')->sum('qty_order');
     


			$sum_stats['discs_active']=Order::whereHas('stockItem',function($query){$query->where('prodType_id','=','3');})->where('status','=','Active')->sum('qty_order');
			$sum_stats['combos_active']=Order::whereHas('stockItem',function($query){$query->where('prodType_id','=','4');})->where('status','=','Active')->sum('qty_order');


			$sum_stats['discs_complete']=Task::whereHas('order.stockItem',function($query){$query->where('prodType_id','=','3');})->whereHas('order',function($query){$query->where('status','=','Active');})->where('is_complete','=','1')->sum('batch_size'); 
			$sum_stats['combos_complete']=Task::whereHas('order.stockItem',function($query){$query->where('prodType_id','=','4');})->whereHas('order',function($query){$query->where('status','=','Active');})->where('is_complete','=','1')->sum('batch_size'); 

			$sum_stats['print_units']=Task::where('is_complete','=','0')->where('action','=','Print')->sum('batch_size'); 
			$sum_stats['bind_units']=Task::where('is_complete','=','0')->where('action','=','Bind')->sum('batch_size'); 
			$sum_stats['box_units']=Task::where('is_complete','=','0')->where('action','=','Box')->sum('batch_size'); 
			$sum_stats['build_units']=Task::where('is_complete','=','0')->where('action','=','Build')->sum('batch_size');

			
			

			$sum_stats['print_imps']=DB::table('tasks')->leftJoin('orders', 'tasks.order_id', '=', 'orders.id')->select(DB::raw('sum(tasks.batch_size*impressions) as sum_imps'))->where('tasks.is_complete','=','0')->where('action','=','Print')->pluck('sum_imps')->toArray();
			$sum_stats['bind_imps']=DB::table('tasks')->leftJoin('orders', 'tasks.order_id', '=', 'orders.id')->select(DB::raw('sum(tasks.batch_size*impressions) as sum_imps'))->where('tasks.is_complete','=','0')->where('action','=','Bind')->pluck('sum_imps')->toArray();
			$sum_stats['box_imps']=DB::table('tasks')->leftJoin('orders', 'tasks.order_id', '=', 'orders.id')->select(DB::raw('sum(tasks.batch_size*impressions) as sum_imps'))->where('tasks.is_complete','=','0')->where('action','=','Box')->pluck('sum_imps')->toArray();
			$sum_stats['build_imps']=DB::table('tasks')->leftJoin('orders', 'tasks.order_id', '=', 'orders.id')->select(DB::raw('sum(tasks.batch_size*impressions) as sum_imps'))->where('tasks.is_complete','=','0')->where('action','=','Build')->pluck('sum_imps')->toArray();
			


           $log=LogEntry::orderBy('created_at','desc')->take(20)->get();



    return view('dashboard', compact('sum_stats','log'));



   }



   public function logs()

   {

      
   
    $log=LogEntry::orderBy('created_at','desc')->take(60)->get();

    

    return view('log', compact('log'));



   }



   public function genReport(Request $request)
   {




	if(request('date1')==NULL && request('date2')==NULL && request('sku')!==NULL)
    {}

   

	if(request('sku')!==NULL)
   	{
	
	$items=StockItem::where('name','LIKE','%'.request('sku').'%')->pluck('id')->toArray();
	$items=join("','",$items);  
	$query[0]="item_id in ('$items')";

	}


	if(request('date1')!==NULL && request('date2')!==NULL)
	{

    $date1=request('date1');
    $date2=request('date2');

	$query[1]="date_complete between '$date1' and '$date2' ";

	}	

   
	$query[2]="status='Complete'";
   	



    if(isset($query))
	{
	$queryString=join(" AND ",$query);


	$results=DB::table('orders')->leftJoin('stock_items','orders.item_id','=','stock_items.id')->selectRaw('name, description, qty_complete, impressions, priority, date_complete,  date_order, date_due ')->whereRaw($queryString)->get()->toArray();   	

	$sumStats=DB::table('orders')->leftJoin('stock_items','orders.item_id','=','stock_items.id')->selectRaw('count(*) AS count, sum(qty_complete) as totItems, sum(impressions*qty_complete) AS totImps  ')->whereRaw($queryString)->get()->toArray();   	
	}
	else
	{
	$queryString='';

	$results=DB::table('orders')->leftJoin('stock_items','orders.item_id','=','stock_items.id')->selectRaw('name, description, qty_complete, impressions, priority, date_complete,  date_order, date_due ')->get()->toArray();      	


	$sumStats=DB::table('orders')->leftJoin('stock_items','orders.item_id','=','stock_items.id')->selectRaw('count(*) AS count, sum(qty_complete) as totItems, sum(impressions*qty_complete) AS totImps  ')->get()->toArray();   	
}

    return view('reports', compact('results','queryString', 'sumStats'));


   }





    //
}
