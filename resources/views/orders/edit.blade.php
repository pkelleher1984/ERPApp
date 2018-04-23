@extends('_layouts.master')




@section('content')


<?php $qp=$qty['processing'];

$min_qty_adj=$qp+$order->qty_complete?>


{{ Form::model($order,array ('route' => ['orders.update', $order], 'method' => 'PUT'))}}



      <div class="row">
        <div class="col-md-12">
          <div class="tile">



<div>
<h3>Order Details on {{$order->stockItem->name}} (Status: {{$order->status}}) <button type="button" class="close" aria-label="Close">
<span aria-hidden="true"><a href='/orders/{{strtolower($order->StockItem->RefStockItemType->name)}}' style="color:black; text-decoration: none">&times;</a></span>
</button></h3>
</div>







<hr>



<div class="form-row ">
        <div class='form-group col-md-3'>
        {{Form::label('prod_type', 'Product Type:', array('class' => 'label'))}}
        {{Form::text('prod_type',$order->StockItem->RefStockItemType->name,  array('class' => 'form-control', 'readonly'=>'true'))}}
        </div>


   <div class="bs-component" style="margin-top:28px; ">

 <button type="submit" class="btn btn-success">Update</button>

 <a href='/orders/{{$order->id}}'><button type="button" class="btn btn-danger">Cancel</button></a>
 
 
        </div>
        
</div>



<hr>
<div class="form-row col-md-12">
        <div class='form-group col-md-6'>
        {{Form::label('sku', 'SKU:', array('class' => 'label'))}}<br>
       {{Form::text('sku',$order->stockItem->name, array('class' => 'form-control','readonly' => 'true'))}}
       
         </div>
</div>



<div class="form-row col-md-12">

          <div class='form-group col md-2'>
        {{Form::label('qty_order', 'Quantity:')}}
        {{Form::number('qty_order',null,  array('id'=> 'quantity','class' => 'form-control','min' => $min_qty_adj))}}
         </div>

   <div class='form-group col md-2'>
        {{Form::label('date_due', 'Date Due:')}}
        {{Form::Date('date_due',\Carbon\Carbon::parse($order->date_due),  array('class' => 'form-control'))}}
         </div>

  <div class='form-group col md-2'>
        {{Form::label('priority', 'Priority:')}}
        {{Form::text('priority',null,  array('class' => 'form-control'))}}
         </div>



          <div class='form-group col md-2'>
        {{Form::label('batch_size', 'Batch Size:')}}
        {{Form::text('batch_size',null,  array('class' => 'form-control'))}}
         </div>


  <div class='form-group col md-2'>
        {{Form::label('qty_complete', 'Quantity Complete:')}}
        {{Form::text('qty_complete',null,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

<div class='form-group col md-2'>
        {{Form::label('qty_processing', 'Quantity Processing:')}}
        {{Form::text('qty_processing',$qp,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>


</div>


@if($order->status!='Planned')
<div class="form-row col-md-12">


<div class="bs-component col-md-12">
              <div class="alert alert-dismissible alert-warning">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <table class="col-md-12">
<th><tr>
    <td></td>
<td><b>Printed</b></td>
<td><b>Bound</b></td>
<td><b>Boxed</b></td>
<td><b>Built</b></td>
</tr>  
</th>
<tbody>

<tr style="border-bottom: 1px solid grey;">
<td><b>Quantity Complete</b></td>
<td>{{$qty['printed']}}</td>
<td>{{$qty['bound']}}</td>
<td>NA</td>
<td>{{$qty['built']}}</td>  
</tr>
<tr>
<td><b>Last Complete Time Stamp</b></td>
<td>{{($qty['printedLast']=='NA') ? 'NA'  : date('h:i a m/d/Y', strtotime($qty['printedLast']))}}</td>
<td>{{($qty['boundLast']=='NA') ? 'NA'  : date('h:i a m/d/Y', strtotime($qty['boundLast']))}}</td>
<td>NA</td>
<td>{{($qty['builtLast']=='NA') ? 'NA'  : date('h:i a m/d/Y', strtotime($qty['builtLast']))}}</td>  
</tr>
</tbody>
</table>
              </div>
            </div>


</div>
@endif

<div class="form-row col-md-12">

<div class="col md-3">

        <div class='form-group'>
        {{Form::label('Description', 'Description:')}}
        {{Form::text('description',null,  array('class' => 'form-control'))}}
         </div>

      <div class='form-group'>
        {{Form::label('notes', 'Order Notes:')}}
        {{Form::textarea('notes',null,  array('class' => 'form-control'))}}
         </div>

</div>

</div>



<hr>

@if($order->StockItem->RefStockItemType->name=='Book')

<div class="form-row col-md-12">

          <div class='form-group col-md-2'>
        {{Form::label('impressions', 'Impressions:')}}
        {{Form::text('impressions',$order->stockItem->book->impressions,  array('id'=> 'impressions','class' => 'form-control','readonly' => 'true'))}}
         </div>

        <div class='form-group col-md-2'>   
        {{Form::label('finish', 'Finish:')}}
        {{Form::text('finish',$order->stockItem->book->RefFinish->name, array('class' => 'form-control','readonly' => 'true'))}}
        </div>

        <div class='form-group col-md-2'>
        {{Form::label('punch', 'Punch Count:')}}
        {{Form::text('punch',$order->stockItem->book->punch,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>
        

         <div class='form-group col-md-2'>
        {{Form::label('binding', 'Binding:')}}
        {{Form::text('binding',$order->stockItem->book->RefBinding->name,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>
          <div class='form-group col-md-2'>
        {{Form::label('duplex', 'Duplex:')}}
        {{Form::text('duplex',$order->stockItem->book->duplex,  array('class' => 'form-control','readonly' => 'true'))}}
         </div>


 <div class='form-group col-md-2'>
        {{Form::label('imp_ordered', 'Impressions Ordered:')}}
        {{Form::text('imp_ordered',number_format($order->stockItem->book->impressions*$order->qty_order),  array('id'=> 'imp_ordered','class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>



@endif



{!! Form::close() !!}

</div></div></div>





      
       


<script type="text/javascript">
    

     $(document).ready(function() {


        const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


  //AUTOCALCULATE SCRIPT

    var qty=$("#quantity");
    qty.keyup(function(){
        var total=isNaN(parseInt(qty.val()* $("#impressions").val())) ? 0 :(qty.val()* $("#impressions").val())
        $("#imp_ordered").val(numberWithCommas(total));
    });
});


</script>



@endsection