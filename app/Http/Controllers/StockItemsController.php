<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RefFinish;
use App\StockItem;
use App\Book;
use App\Disc;
use App\Combo;



use App\RefBinding;
use App\RefStockItemType;
use App\LogEntry;

class StockItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

{

      
      

      

      
    $itemSlug=basename($request->path());
                 
    $prodType_id=RefStockItemType::where('name','=',$itemSlug)->pluck('id')->toArray();

    $stockItems=StockItem::with('RefStockItemType')->where('prodType_id','=',$prodType_id)->get()->toArray();
         

       $stockItems_flattened = array(); //the below loop filters and flattens the array form of the collection obj.
    
           for ($i=0; $i<sizeof($stockItems); $i++)
            {
                $stockItems_flattened[$i]['id']=$stockItems[$i]['id']; 
                
                $stockItems_flattened[$i]['name']=$stockItems[$i]['name']; 
                
                $stockItems_flattened[$i]['desc']=$stockItems[$i]['desc'];  
                
                $stockItems_flattened[$i]['ver']=$stockItems[$i]['ver'];  
                
                $stockItems_flattened[$i]['created_at']=$stockItems[$i]['created_at'];  
                
                $stockItems_flattened[$i]['updated_at']=$stockItems[$i]['updated_at'];  
                
                $stockItems_flattened[$i]['prod_type']=$stockItems[$i]['ref_stock_item_type']['name'];  
                
               }


           $stockItems=$stockItems_flattened; 


    return view('stockitems.index', compact('stockItems','itemSlug')); //
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $bindings=RefBinding::all();
       $finishes=RefFinish::all();
       $types=RefStockItemType::all();      
       $stockItems=StockItem::all(); 
 
  $type=refStockItemType::where('name','=',request('type'))->pluck('id')->toArray()[0];


    return view('stockitems.create', compact('bindings','types','finishes','stockItems','type')); //




 
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


 $stockItem=StockItem::create([
'name'=>request('name'),
'desc'=>request('desc'),
'ver'=>request('ver'),
'prodType_id'=>request('prodType_id'),
'active'=>1,
'for_sale'=>1,
       ]);

 if($stockItem->prodType_id==2)
  {
  $book=Book::create([
    'item_id'=>$stockItem->id,
    'skuname'=>$stockItem->name,
    'active'=>$stockItem->active,
    'duplex'=>request('duplex'),
    'binding_id'=>request('binding_id'),
    'finish_id'=>request('finish_id'),
    'batch_size'=>request('batch_size'),
    'punch'=>request('punch'),
    'impressions'=>request('impressions'),
  ]);
$slug='/stockitems/book';

}
      
 if($stockItem->prodType_id==3)
  {
  $disc=Disc::create([
    'item_id'=>$stockItem->id,
    'skuname'=>$stockItem->name,
    'batch_size'=>request('batch_size'),
    'disc_count'=>request('disc_count'),
  ]);
$slug='/stockitems/disc';

}

 
  if($stockItem->prodType_id==4)
  {
  $combo=Combo::create([
    'item_id'=>$stockItem->id,
    'skuname'=>$stockItem->name,
    'batch_size'=>request('batch_size'),
    'component_list'=>(json_encode(request('components'))),
    
  ]);

$slug='/stockitems/combo';
}     



$msg="New ".$stockItem->refStockItemType->name." ".$stockItem->name." created";
     LogEntry::create(['logtext'=>$msg]);

    return redirect($slug)->with('message',$msg);






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       $stockItem=stockItem::with('RefStockItemType','book.RefFinish','book.RefBinding')->find($id);
       $bindings=RefBinding::all();
       $finishes=RefFinish::all();
       $types=RefStockItemType::all();      
       $stockItems=StockItem::all(); 




    return view('stockitems.show', compact('stockItem','bindings','finishes','types','stockItems')); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $stockItem=stockItem::with('RefStockItemType','book.RefFinish','book.RefBinding')->find($id);
       $bindings=RefBinding::all();
       $finishes=RefFinish::all();
       $types=RefStockItemType::all();      
       $stockItems=StockItem::all(); 




    return view('stockitems.edit', compact('stockItem','bindings','finishes','types','stockItems'));    //
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

                 
 $stockItem=StockItem::find($id);


 $stockItem->update([
'name'=>request('name'),
'desc'=>request('desc'),
'ver'=>request('ver'),
       ]);

 if($stockItem->prodType_id==2)
  {
    $stockItem->book->update([
    'skuname'=>$stockItem->name,
    'duplex'=>request('duplex'),
    'binding_id'=>request('binding_id'),
    'finish_id'=>request('finish_id'),
    'batch_size'=>request('batch_size'),
    'punch'=>request('punch'),
    'impressions'=>request('impressions'),
  ]);
$slug='/stockitems/book';

}
      
 if($stockItem->prodType_id==3)
  {
  $stockItem->disc->update([
    'skuname'=>$stockItem->name,
    'batch_size'=>request('batch_size'),
    'disc_count'=>request('disc_count'),
  ]);
$slug='/stockitems/disc';

}

 
  if($stockItem->prodType_id==4)
  {
  $stockItem->combo->update([
    'skuname'=>$stockItem->name,
    'batch_size'=>request('batch_size'),
    'component_list'=>(json_encode(request('components'))),
    
  ]);

$slug='/stockitems/combo';
}     



$msg=$stockItem->refStockItemType->name." ".$stockItem->name." updated.";
     LogEntry::create(['logtext'=>$msg]);

    return redirect($slug)->with('message',$msg);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $stockItem=StockItem::find($id);
       
   if($stockItem->prodType_id==2)
  {
     $slug='/stockitems/book';
     Book::where('item_id','=',$id)->delete();
     
   }

if($stockItem->prodType_id==3)
  {
     $slug='/stockitems/disc';
     Disc::where('item_id','=',$id)->delete();
     
   }


if($stockItem->prodType_id==4)
  {
     $slug='/stockitems/combo';
     Combo::where('item_id','=',$id)->delete();
     
   }



$msg=$stockItem->refStockItemType->name." ".$stockItem->name." deleted.";

LogEntry::create(['logtext'=>$msg]);

$stockItem->delete();

return redirect($slug)->with('message',$msg);




}



}