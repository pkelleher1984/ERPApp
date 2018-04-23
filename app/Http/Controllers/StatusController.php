<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Order;

use App\Task;

use App\LogEntry;


use Carbon\Carbon;


class StatusController extends Controller
{
  
  public function userChange($id)
    {
        

        Auth::loginUsingId($id, true);



        return redirect()->back();


    }



     public function adminLogin(request $request)
    {
        
        Auth::logout();
        if (Auth::attempt(['email' => request('email'), 'password' =>  request('password')]))
        {
            return redirect()->back();
        }

        else{
        return redirect()->back();
      }



    } 

   public function userLogout()
    {



        Auth::logout();

        return redirect()->back();

    } 




  public function activateOrder($id)
  {
     

     $order=Order::find($id);


     $type=$order->stockItem->refStockItemType->name; 
     $name=$order->stockItem->name;      
      
     if($order->batch_size>$order->qty_order) //EDGE CASE WHEN ORDER ENDER WITH QTY < BATCH
     
     {


      $order->batch_size=$order->qty_order; 
     

     }
      if($order->status=='Active')
     {


        

     $msg="Someone beat you to it. Order already activated.";

     $type=lcfirst($type);
  
    return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);

     }


     if($order->status=='Planned')
     {


        if($order->stockItem->prodType_id=='2') //Print books build all else

          {$action='Print';}

        else {$action='Build';}


      $order->update(['status'=> 'Active','date_order' => Carbon::Now()]);
     
      Task::create([
      'batch_number'=>'1',
      'order_id'=>$order->id,
      'action'=>$action,
      'is_complete'=>'0',
      'progress'=>'0',
      'batch_size'=>$order->batch_size,
         ]);


     $msg="Order # ".$id." for ".$name." has been activated. First ".$action." task has been generated.";

     

     }

    if($order->status=='Hold')
     {
       $order->update(['status'=> 'Active']);
       
            $msg="Order # ".$id." for ".$name." has been reactivated.";

     }


 LogEntry::create(['logtext'=>$msg]);


 $type=lcfirst($type);

  return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);



  }




  public function holdOrder($id)
  {
       
        $order=Order::find($id);
  
         $type=$order->stockItem->refStockItemType->name; 
         $name=$order->stockItem->name;      

        $order->update(['status'=> 'Hold']);

        $msg="Order # ".$id." for ".$name." has been placed on hold.";

  
  LogEntry::create(['logtext'=>$msg]);

 $type=lcfirst($type);
return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);
 
  }




  
  public function completeTask(request $request, $id)
  {

    
   
      
      $task=Task::find($id);

      $actionSlug=lcfirst($task->action);

      if($task->is_complete==1) //fix double user  / double complete glitch.
      {

      $msg="Someone beat you to it. Task already complete.";

      return redirect()->route('tasks.'.$actionSlug)->with('message',$msg)->with('action',$actionSlug); 

      } 


      $order=Order::find($task->order_id);

      $name=$order->stockItem->name;      

      $msg=$task->action." Task on Order # ".$order->id." for ".$name." Completed. ";
      $task->update(['resource_id'=>request('resource_id'),
                     'user_id'=>request('user_id'),]);

      
      if ($request->has('batch_size')){
      if(request('batch_size')!=$task->batch_size)
                  { 
                    $task->update(['batch_size'=>request('batch_size')]);


                  }

              if(request('change_def')=='1')
                  {
                   
                    $order->update(['batch_size'=>request('batch_size')]);
                  }
      }
      


      
      $progress_in=$task->progress;
    
      $progress_out=$progress_in + $task->batch_size;
                 
      $task->update(['is_complete'=>'1','progress'=>$progress_out]);
      


//BUILD LOGIC
     if($task->action=='Build')
          { 


                       if(($task->order->qty_order-$task->progress)>=$task->order->batch_size) //Case when a full batch or greater remains
                        {
                        
                        $task_batch_size=$task->order->batch_size;
                        
                        Task::create([
                        'batch_number'=> ($task->batch_number+1),
                        'order_id'=>$task->order->id,
                        'action'=>'Build',
                        'is_complete'=>'0',
                        'progress'=>$progress_out,
                        'batch_size'=>$task_batch_size,
                        'resource_id'=>request('resource_id'),
                        'user_id'=>request('user_id'),
                                          ]);
                        
                        $msg.='New Build Task Created. ';
                        }
                        


                      elseif((($task->order->qty_order-$task->progress)<$task->order->batch_size) && ($task->order->qty_order-$task->progress)>0)  //Case when less than a full batch remains
                        {
                        $task_batch_size=($task->order->qty_order-$task->progress);
                        
                        Task::create([
                        'batch_number'=> ($task->batch_number+1),
                        'order_id'=>$task->order->id,
                        'action'=>'Build',
                        'is_complete'=>'0',
                        'progress'=>$progress_out,
                        'batch_size'=>$task_batch_size,
                        'resource_id'=>request('resource_id'),
                        'user_id'=>request('user_id'),
                                  ]);
                        $msg.='New Build Task Created. ';
                        }
                  
                      elseif(($task->order->qty_order-$task->progress)==0) //Case when nothing remains
                  
                        {  }


                          $order=Order::find($task->order_id);
                           $order->update(['qty_complete'=>$order->qty_complete+$task->batch_size]); 


 if(Task::where('order_id','=',$task->order_id)->where('is_complete','=','0')->get()->isEmpty()) // CHECK FOR COMPLETION
   {

        $order=Order::find($task->order_id);
        $order->update(['status'=> 'Complete']);
        $order->update(['date_complete'=> Carbon::now()]);
        $msg.='Order #'.$task->order_id. ' is complete. ';


      LogEntry::create(['logtext'=>$msg]);

      return redirect()->route('tasks.'.$actionSlug)->with('message',$msg)->with('action',$actionSlug); 
   }
      }                  

//END BUILD LOGIC



      if($task->action=='Print')
          { 


                       if(($task->order->qty_order-$task->progress)>=$task->order->batch_size) //Case when a full batch or greater remains
                        {
                        
                        $task_batch_size=$task->order->batch_size;
                        
                        Task::create([
                        'batch_number'=> ($task->batch_number+1),
                        'order_id'=>$task->order->id,
                        'action'=>'Print',
                        'is_complete'=>'0',
                        'progress'=>$progress_out,
                        'batch_size'=>$task_batch_size,
                        'resource_id'=>request('resource_id'),
                        'user_id'=>request('user_id'),
                                          ]);
                        
                        $msg.='New Print Task Created. ';
                        }
                        


                    elseif((($task->order->qty_order-$task->progress)<$task->order->batch_size) && ($task->order->qty_order-$task->progress)>0)  //Case when less than a full batch remains
                        {
                        $task_batch_size=($task->order->qty_order-$task->progress);
                        
                        Task::create([
                        'batch_number'=> ($task->batch_number+1),
                        'order_id'=>$task->order->id,
                        'action'=>'Print',
                        'is_complete'=>'0',
                        'progress'=>$progress_out,
                        'batch_size'=>$task_batch_size,
                        'resource_id'=>request('resource_id'),
                        'user_id'=>request('user_id'),
                                  ]);
                        $msg.='New Print Task Created. ';
                        }
                  
                      elseif(($task->order->qty_order-$task->progress)==0) //Case when nothing remains
                  
                        {  }
                   

    //onlycreate if no bind task exists

      Task::create([
      'batch_number'=>($task->batch_number),
      'order_id'=>$task->order->id,
      'action'=>'Bind',
      'is_complete'=>'0',
      'progress'=>$progress_in,
      'batch_size'=>$task->batch_size,
      'user_id'=>request('user_id'),
       ]);
      $msg.='New Bind Task Created. ';
      }

//END PRINT LOGIC


      if($task->action=='Bind')
  
                  { 

                  Task::create([
                  'batch_number'=>($task->batch_number),
                  'order_id'=>$task->order->id,
                  'action'=>'Box',
                  'is_complete'=>'1', //Temp fix for kill box
                  'progress'=>$progress_in,
                  'batch_size'=>$task->batch_size,
                  'user_id'=>request('user_id'),

                     ]);
                   $msg.='New Box Task Created. ';



               $order=Order::find($task->order_id);
               $order->update(['qty_complete'=>$order->qty_complete+$task->batch_size]); 



                   }



         //create another one if there are prints to bind



       if($task->action=='Box')
            {  



                             }   


    if(Task::where('order_id','=',$task->order_id)->where('is_complete','=','0')->get()->isEmpty()) // CHECK FOR COMPLETION
   {

$order=Order::find($task->order_id);
       $order->update(['status'=> 'Complete']);
         $order->update(['date_complete'=> Carbon::now()]);
    $msg.='Order #'.$task->order_id. ' is complete. ';


   LogEntry::create(['logtext'=>$msg]);
  


      return redirect()->route('tasks.'.$actionSlug)->with('message',$msg)->with('action',$actionSlug); 
   }


       
       else 

        {   


        LogEntry::create(['logtext'=>$msg]);


      return redirect()->route('tasks.'.$actionSlug)->with('message',$msg)->with('action',$actionSlug); 


     }

  }







    public function completeOrder($id)   ///figure out how to call this function within this class...
  {


$order=Order::find($id);
       $order->update(['status'=> 'Complete']);
         $order->update(['date_complete'=> Carbon::now()]);
    return redirect()->route('orders.index'); 
           

    
  }






}
