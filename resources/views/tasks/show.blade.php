@extends('_layouts.master')



@section('content')



 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>





{{ Form::model($order)}}

{{-- {{print_r($order)}}<br><br><br>
{{print_r($stockItem)}}<br><br><br>
 --}}
<div class="row">
        <div class="col-md-12">
          <div class="tile">

<div>

      



<h3>Order Details on {{$order->stockItem->name}} (Status: {{$order->status}}) <button type="button" class="close" aria-label="Close">
  <span aria-hidden="true"><a href='javascript:history.back()' style="color:black; text-decoration: none">&times;</a></span>
</button></h3>
</div>







<hr>



        <div class="form-row ">
        <div class='form-group col-md-3'>
        {{Form::label('prod_type', 'Product Type:', array('class' => 'label'))}}
        {{Form::text('prod_type',$order->StockItem->RefStockItemType->name,  array('class' => 'form-control','readonly' => 'true'))}}
        </div>


   <div class='form-group col-md-3'>
        {{Form::label('action', 'Action:', array('class' => 'label'))}}
        {{Form::text('action',$task->action,  array('class' => 'form-control','readonly' => 'true'))}}
        </div>

@if($task->action=='Print'||$task->action=='Build') 


 <div class="btn-group col-md-3" >



                     <a href="/tasks/{{$task->id}}/edit" >



       <button type="button" class="btn btn-info" style="margin-top: 28px;"><i class="app-menu__icon fa fa-edit"></i>Edit</button>  



    </a>

</div> 

@endif    
 

        
        
</div>



<hr>
<div class="form-row col-md-9">
        <div class='form-group col-md-6'>
        {{Form::label('sku', 'SKU:', array('class' => 'label'))}}<br>
       {{Form::text('sku',$order->stockItem->name, array('class' => 'form-control','readonly' => 'true'))}}
       
         </div>
</div>



<div class="form-row col-md-9">

          <div class='form-group col md-3'>
        {{Form::label('qty_order', 'Quantity:')}}
        {{Form::text('qty_order',null,  array('id'=> 'quantity','class' => 'form-control','readonly' => 'true'))}}
         </div>

  <div class='form-group col md-3'>
        {{Form::label('date_due', 'Date Due:')}}
        {{Form::Text('date_due',(!(is_null($order->date_due))) ? \Carbon\Carbon::parse($order->date_due) : null,  array('class' => 'form-control','readonly' => 'true' ))}}
         </div>

  <div class='form-group col md-3 '>
        {{Form::label('priority', 'Priority:')}}
        {{Form::text('priority',null,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>


</div>
<div class="form-row col-md-6">

          <div class='form-group col md-3'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size',$task->batch_size,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>


<div class='form-group col md-3'>
        {{Form::label('qty_complete', 'Quantity Complete:')}}
        {{Form::text('qty_complete',$order->qty_complete,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>

<div class="form-row col-md-9">

<div class="col md-3">

        <div class='form-group'>
        {{Form::label('desc', 'Description:')}}
        {{Form::text('desc',null,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

      <div class='form-group'>
        {{Form::label('notes', 'Order Notes:')}}
        {{Form::textarea('notes',null,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>

</div>

@if($order->StockItem->RefStockItemType->name=='Book')

<hr><hr>



<div class="form-row">

          <div class='form-group col-md-3'>
        {{Form::label('impressions', 'Impressions:')}}
        {{Form::text('impressions',$order->stockItem->book->impressions,  array('id'=> 'impressions','class' => 'form-control','readonly' => 'true'))}}
         </div>

        <div class='form-group col-md-3'>   
        {{Form::label('finish', 'Finish:')}}
        {{Form::text('finish',$order->stockItem->book->RefFinish->name, array('class' => 'form-control','readonly' => 'true'))}}
        </div>

        <div class='form-group col-md-3'>
        {{Form::label('punch', 'Punch Count:')}}
        {{Form::text('punch',$order->stockItem->book->punch,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>
        
</div>

<div class="form-row">

         <div class='form-group col-md-3'>
        {{Form::label('binding', 'Binding:')}}
        {{Form::text('binding',$order->stockItem->book->RefBinding->name,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>
          <div class='form-group col-md-3'>
        {{Form::label('duplex', 'Duplex:')}}
        {{Form::text('duplex',$order->stockItem->book->duplex,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>

<div class="form-row">

 <div class='form-group col-md-3'>
        {{Form::label('imp_ordered', 'Impressions Ordered:')}}
        {{Form::text('imp_ordered',number_format(($order->stockItem->book->impressions*$order->qty_order)),  array('id'=> 'imp_ordered','class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>
@endif

{!! Form::close() !!}








      
       






@endsection