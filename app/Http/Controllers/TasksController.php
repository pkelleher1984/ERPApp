<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Order;
use App\User;
use DB;

use App\LogEntry;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   


if (session('action'))
    
    {$action=session('action');}
    
else
    {$action=basename($request->path());}




    $tasks=Task::with('Order','Order.stockItem','Order.stockItem.refStockItemType')->where('is_complete','=','0')->where('action','=',$action)->get()->toArray();


           $tasks_flattened = array(); //the below loop filters and flattens the array form of the collection obj.
           for ($i=0; $i<sizeof($tasks); $i++)
              { $tasks_flattened[$i]['priority']=$tasks[$i]['order']['priority']; 
               // $tasks_flattened[$i]['order_id']=$tasks[$i]['order_id'];  
                $tasks_flattened[$i]['task_id']=$tasks[$i]['id'];  
                $tasks_flattened[$i]['sku_name']=$tasks[$i]['order']['stock_item']['name'];  
    
                $tasks_flattened[$i]['action']=$tasks[$i]['action'];  
                $tasks_flattened[$i]['batch_size']=$tasks[$i]['batch_size'];  
                $tasks_flattened[$i]['qty_order']=$tasks[$i]['order']['qty_order']; 
                $tasks_flattened[$i]['progress']=$tasks[$i]['progress']; 

                $tasks_flattened[$i]['qty_complete']=$tasks[$i]['order']['qty_complete'];  
                //$tasks_flattened[$i]['order_status']=$tasks[$i]['order']['status'];  

                 //batch progress logic


                $batches_remaining=ceil(($tasks[$i]['order']['qty_order']-$tasks[$i]['progress'])/$tasks[$i]['order']['batch_size']);
                $total_batches=$tasks[$i]['batch_number']+$batches_remaining-1;    
                $batch_progress=$tasks[$i]['batch_number']." / ".$total_batches; 
                $tasks_flattened[$i]['batch_progress']=$batch_progress;



                if(!is_null($tasks[$i]['order']['date_due']))
                {$tasks_flattened[$i]['date_due']=date("Y/m/d",strtotime($tasks[$i]['order']['date_due'])); }
                else
                {$tasks_flattened[$i]['date_due']='-';}    


                $tasks_flattened[$i]['order_description']=$tasks[$i]['order']['description'];  
                $tasks_flattened[$i]['order_notes']=substr($tasks[$i]['order']['notes'],0,50)." ...";  
                $tasks_flattened[$i]['user_id']=$tasks[$i]['user_id'];  
                $tasks_flattened[$i]['resource_id']=$tasks[$i]['resource_id'];  
                $tasks_flattened[$i]['type']=$tasks[$i]['order']['stock_item']['ref_stock_item_type']['name'];  


               }            
           $tasks=$tasks_flattened; 

       $users=User::all()->pluck('name','id')->toArray(); 
        $action=ucwords($action);


        if ($action=='Bind' || $action=='Box')
        {

        $sumStats=DB::table('tasks')->join('orders', 'orders.id', '=', 'tasks.order_id')->join('stock_items', 'stock_items.id', '=', 'orders.item_id')->selectRaw('round(avg(priority),0) as priority, name, count(*) as batches_ready, sum(tasks.batch_size) as quantity_ready,  round(avg(qty_order),0) as qty_order ')->whereRaw('is_complete=0 and action = ?',$action)->groupBy('name')->orderBy('priority','ASC')->get()->toArray();

   return view('tasks.index', compact('tasks','action','sumStats','users')); 

        }


else{
    return view('tasks.index', compact('tasks','action','users')); 
}

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $task=Task::find($id);
         $order=Order::find($task->order_id);
             // $stockItem=Order::find($id)->stockItem; //UNNESSECARY
              //$book=Order::with('StockItem.Book.RefBinding','StockItem.Book.RefFinish')->find($id); NOT NEEDED COMPACT CONTAINS SUB JOINS


         return view('tasks.show', compact('order','task')); //
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                 $task=Task::find($id);
                 $order=Order::find($task->order_id);
             // $stockItem=Order::find($id)->stockItem; //UNNESSECARY
              //$book=Order::with('StockItem.Book.RefBinding','StockItem.Book.RefFinish')->find($id); NOT NEEDED COMPACT CONTAINS SUB JOINS


         return view('tasks.edit', compact('order','task')); // //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $task=Task::find($id);
          if(request('batch_size')!=$task->batch_size)
                  { 
                    $task->update(['batch_size'=>request('batch_size')]);


                  }

              if(request('change_def')=='1')
                  {
                    $order=Order::find($task->order_id);
                    $order->update(['batch_size'=>request('batch_size')]);
                  }


         
         $actionSlug=strtolower(request('action'));

      return redirect()->route('tasks.'.$actionSlug)->with('action',$actionSlug); 
         

          // //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
