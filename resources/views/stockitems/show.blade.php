@extends('_layouts.master')




@section('content')

@include('layouts.modalStockItem')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    


    <div class="app-title">
        <div>
          <h1><i class="fa fa-database"></i> Stock Item Details</h1>
        
        </div>

      </div>
 



{{ Form::model($stockItem)}}


      <div class="row">
        <div class="col-md-12">
          <div class="tile">

<div>
<h3>{{$stockItem->name}} <button type="button" class="close" aria-label="Close">
<span aria-hidden="true"><a href='/stockitems/{{strtolower($stockItem->RefStockItemType->name)}}' style="color:black; text-decoration: none">&times;</a></span>
</button></h3>
</div>

<hr>

 <div class="form-row col-md-9" >



<div class='form-group col-md-3'>
		{{Form::label('prod_type', 'Product Type:', array('class' => 'label'))}}
		    {{Form::text('prodType_id', $stockItem->RefStockItemType->name ,  array('id'=>'type','class' => 'form-control', 'readonly'=>'true'))}}

 
		</div>

		
  <div class='form-group  col-md-3'>
		{{Form::label('sku', 'SKU:', array('class' => 'label'))}}
		{{Form::text('name', NULL,  array('class' => 'form-control','required','readonly'=>'true'))}}
		</div>

@if(!Auth::guest() && Auth::user()->admin==1)

   <div class="bs-component" style="margin-top:28px; ">
                      {{ link_to_route('stockitems.edit','Edit',$stockItem,['class'=>'btn btn-info']) }} 
                    {{ link_to_route('orders.destroy','Delete',$stockItem,['class'=>'btn btn-danger','data-toggle'=>'modal', 'data-target'=>'#6']) }} 


</div>
@endif
		
		 <div class="form-row col-md-9" >


     <div class='form-group  col-md-9'>
        {{Form::label('description', 'Description:')}}
        {{Form::text('desc',NULL,  array('class' => 'form-control','readonly'=>'true'))}}

         </div>
</div>



     @if($stockItem->prodType_id==4)   
 <div class='components form-group col-md-6'>
   

       {{Form::label('components', 'Component SKUs:', array('class' => 'label'))}}

       <br>
         
       
  {{--       <select class="js-example-basic-single" name="components[]" multiple="multiple" style="width:385;">
               @foreach ($stockItems as $item)
                @if($item->prodType_id!='4')
                <option value="{!!$item->id!!}"   @if(in_array($item->id,json_decode($stockItem->combo->component_list))) selected @endif) >{!!$item->name!!}</option>
               @endif
               @endforeach
         </select> --}}

       <select name="components[]" multiple="multiple" style="width:385;" readonly>
               @foreach ($stockItems as $item)
                @if($item->prodType_id!='4')
                @if(in_array($item->id,json_decode($stockItem->combo->component_list)))
                <option value="{!!$item->id!!}" selected ) >{!!$item->name!!}</option>
                @endif
               @endif
               @endforeach
         </select>


         </div>

       




   @endif      


<hr>


@if($stockItem->prodType_id==2)

<div class="div1 form-row col-md-9">

          <div class='form-group  col-md-3'>
        {{Form::label('impressions', 'Impressions:')}}
        {{Form::text('impressions',$stockItem->book->impressions,  array('id'=> 'impressions','class' => 'form-control','required','readonly'=>'true'))}}
         </div>

        <div class='form-group  col-md-3'>   
        {{Form::label('finish', 'Finish:')}}
        {{Form::text('finish',$stockItem->book->RefFinish->name,  array('class' => 'form-control','readonly'=>'true'))}}     
        </div>

        <div class='form-group  col-md-3'>
        {{Form::label('punch', 'Punch Count:')}}
        {{Form::text('punch',$stockItem->book->punch,  array('class' => 'form-control','readonly'=>'true'))}}
         </div>
        
</div>

<div class="div2 form-row  col-md-9">

         <div class='form-group col-md-3'>
        {{Form::label('binding', 'Binding:')}}
        {{Form::text('bining',$stockItem->book->RefBinding->name,  array('class' => 'form-control','readonly'=>'true'))}}
               
         </div>
          <div class='form-group col-md-3'>
        {{Form::label('duplex', 'Duplex:')}}
        {{Form::text('duplex',$stockItem->book->duplex,  array('class' => 'form-control','readonly'=>'true'))}}

         </div>

@endif
  
   

</div>

<div class="form-row col-md-9">


        <div class='form-group col-md-3'>
        {{Form::label('version', 'Version:')}}
        {{Form::text('ver',NULL,  array('class' => 'form-control','readonly'=>'true'))}}
        </div>

@if($stockItem->prodType_id==2)

        <div class='form-group col-md-3'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size',$stockItem->book->batch_size,  array('class' => 'form-control','required','readonly'=>'true'))}}
         </div>

@elseif($stockItem->prodType_id==4)

        <div class='form-group col-md-3'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size',$stockItem->combo->batch_size,  array('class' => 'form-control','required','readonly'=>'true'))}}
         </div>


@elseif($stockItem->prodType_id==3)

        <div class='form-group col-md-3'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size',$stockItem->disc->batch_size,  array('class' => 'form-control','required','readonly'=>'true'))}}
         </div>




  <div class='disc_count form-group col-md-3'>
        {{Form::label('disc_count', 'Disc Count:')}}
        {{Form::text('disc_count',$stockItem->disc->disc_count,  array('class' => 'form-control','readonly'=>'true'))}}
        </div>
  @endif
</div>


<div class="form-row col-md-12">

 

</div>




{!! Form::close() !!}



      
       




<script>


//HIDE SHOW FIELDS
//$('.form-div2, .form-div3, .form-div4, .form-div5').show();


 </script>



<script>
// SELECT PICKER JSCRIPT
$(document).ready(function() { $('.js-example-basic-single').select2({

  theme: "classic"});});
</script>












@endsection