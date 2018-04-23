<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Order;
use App\LogEntry;
use App\Task;


use App\StockItem;
use App\Book;
use DB;
use Carbon\Carbon;
use App\RefStockItemType;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 




    public function index(Request $request)
    {



      if (session('type'))
    
               {$type=session('type');}
    
    else
        {$type=basename($request->path());}



           $orders=Order::with('stockItem','stockItem.refStockItemType')->whereHas('stockItem.refStockItemType',function($query) use($type) {$query->where('name','=',$type);})->where('status','!=','Complete')->orderBy('status','ASC')->orderBy('priority')->get()->toArray(); 


           $orders_flattened = array(); //the below loop filters and flattens the array form of the collection obj.
           for ($i=0; $i<sizeof($orders); $i++)
            {   $orders_flattened[$i]['priority']=$orders[$i]['priority']; 
                
                $orders_flattened[$i]['id']=$orders[$i]['id'];  
                $orders_flattened[$i]['SKU']=$orders[$i]['stock_item']['name']; 
                $orders_flattened[$i]['type']=$orders[$i]['stock_item']['ref_stock_item_type']['name'];  
                $orders_flattened[$i]['status']=$orders[$i]['status'];  
                
               // if(!is_null($orders[$i]['date_complete']))
            //    {$orders_flattened[$i]['date_complete']=date("Y/m/d",strtotime($orders[$i]['date_complete'])); }
             //   else
             //   {$orders_flattened[$i]['date_complete']='-';}    

                if(!is_null($orders[$i]['date_order']))
                {$orders_flattened[$i]['date_order']=date("Y/m/d",strtotime($orders[$i]['date_order'])); }
                else
                {$orders_flattened[$i]['date_order']='-';}  
                
                if(!is_null($orders[$i]['date_due']))
                {$orders_flattened[$i]['date_due']=date("Y/m/d",strtotime($orders[$i]['date_due'])); }
                else
                {$orders_flattened[$i]['date_due']='-';}  


               
                $orders_flattened[$i]['qty_order']=$orders[$i]['qty_order'];  
                $orders_flattened[$i]['qty_complete']=$orders[$i]['qty_complete'];  


                    
                if($orders[$i]['stock_item']['prodType_id']==2)//Show impressions only for books, else: display '.
                {    
                $orders_flattened[$i]['impressions']=number_format($orders[$i]['impressions']*$orders[$i]['qty_order']);  
                }
                else
                {    
                $orders_flattened[$i]['impressions']='NA';  
                }


                  $orders_flattened[$i]['batch_size']=$orders[$i]['batch_size'];  
                 
                $orders_flattened[$i]['order_notes']=substr($orders[$i]['notes'],0,50)." ...";   
                $orders_flattened[$i]['orders_desc']=$orders[$i]['description'];  
  
               }            
           $orders=$orders_flattened; 

  
           $sum_stats['planned']=Order::where('status','=','Planned')->select(DB::raw('sum(impressions * qty_order) as total'))->pluck('total')->toArray();
           $sum_stats['active_ordered']=Order::where('status','=','Active')->select(DB::raw('sum(impressions * qty_order) as total'))->pluck('total')->toArray() ;
           $sum_stats['active_complete']=Order::where('status','=','Active')->select(DB::raw('sum(impressions * qty_complete) as total'))->pluck('total')->toArray() ;

    
$type=ucwords($type);

    return view('orders.index', compact('orders','sum_stats','type')); //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   


        
        


        $type=RefStockItemType::where('name','=',request('type'))->pluck('id')->toArray()[0];
              
               $stockItems=StockItem::all(); 


        return view('orders.create', compact('stockItems','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(request('prodType_id')==2) //Book
        {$sku=request('sku2');
         $imps=request('impressions');
          $type='book';}
        if(request('prodType_id')==3) //Disc
         {$sku=request('sku3');
         $imps=NULL;
           $type='disc';}
        if(request('prodType_id')==4) //Combo
         {$sku=request('sku4');
         $imps=NULL;
           $type='combo';}


     $order=Order::create([

      'item_id' => $sku,
      'status' =>'Planned',
      'qty_order'=> request('qty_order'),
      'date_due'=> request('date_due'),
      'priority' => request('priority'),
      'batch_size' => request('batch_size'),
      'description' => request('description'),
      'notes' => request('notes'),
      'impressions' => $imps,
         
]);
$stockItem=stockItem::find($sku);
$name=$stockItem->name;
$id=$order->id;
$msg="Order #".$id." for ".$name." has been created.";
LogEntry::create(['logtext'=>$msg]);





return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);



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

        
       
     $order=Order::find($id);
     $status=$order->status;     
     
     $stockItem=StockItem::find($order->item_id);
     
     $type=$stockItem->refStockItemType->name;

        $qty['processing']=Task::where('order_id','=',$id)->where('is_complete','=',0)->sum('batch_size') ;


       if( $type=='Book' && $status!='Planned')
        {

        $qty['printed']=Task::where('order_id','=',$id)->where('action','=','Print')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['printed']>0)
        {$qty['printedLast']=Task::where('order_id','=',$id)->where('action','=','Print')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['printedLast']='NA';}
        



        $qty['bound']=Task::where('order_id','=',$id)->where('action','=','Bind')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['bound']>0)
        {$qty['boundLast']=Task::where('order_id','=',$id)->where('action','=','Bind')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['boundLast']='NA';}


        
        $qty['boxed']=Task::where('order_id','=',$id)->where('action','=','Box')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['boxed']>0)
        {$qty['boxedLast']=Task::where('order_id','=',$id)->where('action','=','Box')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['boxedLast']='NA';}



        $qty['built']='NA';
        $qty['builtLast']='NA';
        }
        elseif( $type!='Book' && $status!='Planned')
        {



        $qty['printed']='NA';
        $qty['printedLast']='NA';
        
        $qty['bound']='NA';
        $qty['boundLast']='NA';

        $qty['boxed']='NA';
        $qty['boxedLast']='NA';

        $qty['built']=Task::where('order_id','=',$id)->where('action','=','Build')->where('is_complete','=',1)->sum('batch_size') ;


        if($qty['built']>0)

        {$qty['builtLast']=Task::where('order_id','=',$id)->where('action','=','Build')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
         else
        {$qty['builtLast']='NA';}


      }


             // $stockItem=Order::find($id)->stockItem; //UNNESSECARY
              //$book=Order::with('StockItem.Book.RefBinding','StockItem.Book.RefFinish')->find($id); NOT NEEDED COMPACT CONTAINS SUB JOINS
        return view('orders.show', compact('order','qty'));
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

    $order=Order::find($id);
     $status=$order->status;     
     
     $stockItem=StockItem::find($order->item_id);
     
     $type=$stockItem->refStockItemType->name;

        $qty['processing']=Task::where('order_id','=',$id)->where('is_complete','=',0)->sum('batch_size') ;


       if( $type=='Book' && $status!='Planned')
        {

        $qty['printed']=Task::where('order_id','=',$id)->where('action','=','Print')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['printed']>0)
        {$qty['printedLast']=Task::where('order_id','=',$id)->where('action','=','Print')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['printedLast']='NA';}
        



        $qty['bound']=Task::where('order_id','=',$id)->where('action','=','Bind')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['bound']>0)
        {$qty['boundLast']=Task::where('order_id','=',$id)->where('action','=','Bind')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['boundLast']='NA';}


        
        $qty['boxed']=Task::where('order_id','=',$id)->where('action','=','Box')->where('is_complete','=',1)->sum('batch_size') ;
        
        if($qty['boxed']>0)
        {$qty['boxedLast']=Task::where('order_id','=',$id)->where('action','=','Box')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
        else
        {$qty['boxedLast']='NA';}



        $qty['built']='NA';
        $qty['builtLast']='NA';
        }
        elseif( $type!='Book' && $status!='Planned')
        {



        $qty['printed']='NA';
        $qty['printedLast']='NA';
        
        $qty['bound']='NA';
        $qty['boundLast']='NA';

        $qty['boxed']='NA';
        $qty['boxedLast']='NA';

        $qty['built']=Task::where('order_id','=',$id)->where('action','=','Build')->where('is_complete','=',1)->sum('batch_size') ;


        if($qty['built']>0)

        {$qty['builtLast']=Task::where('order_id','=',$id)->where('action','=','Build')->where('is_complete','=',1)->orderBy('updated_at','desc')->first()->updated_at->timezone('America/Chicago');}
         else
        {$qty['builtLast']='NA';}


      }









         return view('orders.edit',compact('order','qty'));
 ////
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
       

       $id=$order->id;

       $type=$order->stockItem->refStockItemType->name; 

       $name=$order->stockItem->name;

       $msg="Order #".$id." has been updated.";


       $order->update(
        [

      'qty_order'=> request('qty_order'),
      'date_due'=> request('date_due'),
      'priority' => request('priority'),
      'batch_size' => request('batch_size'),
      'description' => request('description'),
      'notes' => request('notes')

  ]);
       $msg="Order #".$id." for ".$name." has been updated.";
LogEntry::create(['logtext'=>$msg]);


$type=lcfirst($type);

 
return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);




 //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
         $id=$order->id;
         
         $type=$order->stockItem->refStockItemType->name; 
         
       $name=$order->stockItem->name;

         
         $msg="Order #".$id." for ".$name." has been deleted.";
         
         $order->delete();
         
         LogEntry::create(['logtext'=>$msg]);
         
         $type=lcfirst($type);

return redirect()->route('orders.'.$type)->with('message',$msg)->with('type',$type);

    }
    


 /*   public function myform()
    {
        $stockItems = DB::table("stock_items")->select("name","id")->get();
        return view('create.blade',compact('stockItems'));
    }
*/

    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function myformAjax($id)
   {
        $type=StockItem::find($id)->prodType_id;



        if($type==2)
     {
      $data = DB::table("books")->leftJoin('ref_bindings', 'books.binding_id', '=', 'ref_bindings.id')->leftJoin('ref_finishes', 'books.finish_id', '=', 'ref_finishes.id')
                ->where("item_id",$id)
               ->select('impressions','skuname','ref_finishes.name as finish','punch','batch_size','ref_bindings.name as binding','duplex')->get();
      }
 
     if($type==3)
          {
      $data = DB::table("discs")->where("item_id",$id)->select('batch_size')->get();
      }
               

     if($type==4)
     {
        $data = DB::table("combos")->where("item_id",$id)
               ->select('batch_size')->get();
      }



        return json_encode($data);

        
    }
}
