@extends('_layouts.master')




@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <div class="app-title">
        <div>
          <h1><i class="fa fa-database"></i> Create New Stock Item</h1>
         
        </div>

      </div>
 



{{ Form::open(['route' => 'stockitems.store', 'method' => 'POST'])}}


      <div class="row">
        <div class="col-md-12">
          <div class="tile">


<div>
<h3>Stock Item Details <button type="button" class="close" aria-label="Close">
  <span aria-hidden="true"><a href='javascript:history.back()' style="color:black; text-decoration: none">&times;</a></span>
</button></h3>
</div><hr>

 <div class="form-row col-md-6" >



<div class='form-group col-md-3'>
		{{Form::label('prod_type', 'Product Type:', array('class' => 'label'))}}
    {{Form::select('prodType_id', array('2' => 'Book','3' => 'Disc','4' => 'Combo'), $type,  array('id'=>'type','class' => 'form-control'))}}

		</div>

		
  <div class='form-group  col-md-3'>
		{{Form::label('sku', 'SKU:', array('class' => 'label'))}}
		{{Form::text('name', '',  array('class' => 'form-control','required'))}}
		</div>

 <div class='button-group col-md-3'>

 <button type="submit" class="btn btn-primary" style="margin-top:28px;">Create</button>
</div>
  



  <div class='form-group  col-md-12'>
     {{Form::label('description', 'Description:')}}
     {{Form::text('desc','',  array('class' => 'form-control'))}}
   </div>


         
</div>

        <div class='components form-group col-md-6'>
        {{Form::label('components', 'Component SKUs:', array('class' => 'label'))}}<br>
        <select class="js-example-basic-single" name="components[]" multiple="multiple" style="width:385;">
           @foreach ($stockItems as $stockItem)
             @if($stockItem->prodType_id!='4')
               <option value="{!!$stockItem->id!!}">{!!$stockItem->name!!}</option>
            @endif
          @endforeach
        </select>
        </div>


         


<hr>





<div class="div1 form-row col-md-9">

          <div class='form-group  col-md-3'>
        {{Form::label('impressions', 'Impressions:')}}
        {{Form::text('impressions','1',  array('id'=> 'impressions','class' => 'form-control','required'))}}
         </div>

        <div class='form-group  col-md-3'>   
        {{Form::label('finish', 'Finish:')}}
             <select class="form-control" name="finish_id">
               @foreach ($finishes as $finish)
                <option value="{!!$finish->id!!}">{!!$finish->name!!}</option>
               @endforeach
         </select>
        </div>

        <div class='form-group  col-md-3'>
        {{Form::label('punch', 'Punch Count:')}}
        {{Form::text('punch','',  array('class' => 'form-control'))}}
         </div>
        
</div>

<div class="div2 form-row  col-md-9">

         <div class='form-group col-md-3'>
        {{Form::label('binding', 'Binding:')}}
      <select class="form-control" name="binding_id">
               @foreach ($bindings as $binding)
                <option value="{!!$binding->id!!}">{!!$binding->name!!}</option>
               @endforeach
         </select>
         </div>
          <div class='form-group col-md-3'>
        {{Form::label('duplex', 'Duplex:')}}
    {{Form::select('duplex', array('1' => 'Yes','0' => 'No'), 'Yes',  array('class' => 'form-control'))}}
         </div>


  
   

</div>

<div class="form-row col-md-9">

        <div class='form-group col-md-3'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size','1',  array('class' => 'form-control','required'))}}
         </div>

   <div class='form-group col-md-3'>
        {{Form::label('version', 'Version:')}}
        {{Form::text('ver','',  array('class' => 'form-control','required'))}}
        </div>


  <div class='disc_count form-group col-md-3'>
        {{Form::label('disc_count', 'Disc Count:')}}
        {{Form::text('disc_count','',  array('class' => 'form-control'))}}
        </div>
  
</div>


<div class="form-row col-md-12">



</div>




{!! Form::close() !!}



      
       




<script>


//HIDE SHOW FIELDS
//$('.form-div2, .form-div3, .form-div4, .form-div5').show();

var target = $('#type option:selected').text();

if(target == "Book")
   $('.components,.disc_count').hide();
else if (target == "Disc")
    $('.div2, .div1, .components').hide();
else if (target == "Combo")
    $('.div2, .div1, .disc_count').hide();







$('#type').change(function () {
    var selected = $('#type option:selected').text();
    $('.div1, .div2').toggle(selected == "Book");
});


$('#type').change(function () {
    var selected = $('#type option:selected').text();
    $('.components').toggle(selected == "Combo");
});



$('#type').change(function () {
    var selected = $('#type option:selected').text();
    $('.disc_count').toggle(selected == "Disc");
});


 </script>



<script>
// SELECT PICKER JSCRIPT
$(document).ready(function() { $('.js-example-basic-single').select2({ theme: "classic"});});
</script>












@endsection