@extends('_layouts.master')




@section('content')




 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

 <div class="app-title">
        <div>
          <h1><i class="fa fa-database"></i> Create New Order</h1>
         
        </div>

      </div>



{{ Form::open(['route' => 'orders.store', 'method' => 'POST'])}}


      <div class="row">
        <div class="col-md-12">
          <div class="tile">

<div>
<h3>Order Details <button type="button" class="close" aria-label="Close">
  <span aria-hidden="true"><a href='javascript:history.back()' style="color:black; text-decoration: none">&times;</a></span>
</button></h3>
</div><hr>
 <div class="form-row col-md-12">
     <div class='form-group col-md-2'>
        {{Form::label('prod_type', 'Product Type:', array('class' => 'label'))}}
            {{Form::select('prodType_id', array('2' => 'Book','3' => 'Disc','4' => 'Combo'), $type,  array('id'=>'type','class' => 'form-control'))}}



</div>

     <div class='form-group col-md-2'>

 <div class="bs-component" style="margin-top:28px; ">

 <button type="submit" class="btn btn-primary">Create</button> 
 <a href='javascript:history.back()' style="color:black; text-decoration: none"><button type="button" class="btn btn-danger">Cancel</button></a>

</div>
</div>
</div>

 <div class="form-row col-md-12">


    <div class='divBook form-group col-md-4'>
        {{Form::label('sku2', 'SKU:', array('class' => 'label'))}}<br>
        <select class="js-example-basic-single" name="sku2" style="width:385;">
               @foreach ($stockItems as $stockItem)
                @if($stockItem->prodType_id=='2')
                <option value="{!!$stockItem->id!!}">{!!$stockItem->name!!}</option>
                @endif
               @endforeach
         </select>
         </div>

		 <div class='divDisc form-group col-md-4'>
        {{Form::label('sku3', 'SKU:', array('class' => 'label'))}}<br>
        <select class="js-example-basic-single" name="sku3"  style="width:385;">
               @foreach ($stockItems as $stockItem)
                @if($stockItem->prodType_id=='3')
                <option value="{!!$stockItem->id!!}">{!!$stockItem->name!!}</option>
               @endif
               @endforeach
         </select>
         </div>

		<div class='divCombo form-group col-md-4'>
        {{Form::label('sku4', 'SKU:', array('class' => 'label'))}}<br>
        <select class="js-example-basic-single" name="sku4" style="width:385;">
               @foreach ($stockItems as $stockItem)
                @if($stockItem->prodType_id=='4')
                <option value="{!!$stockItem->id!!}">{!!$stockItem->name!!}</option>
               @endif
               @endforeach
         </select>
         </div>



<hr>








<div class="form-row col-md-12 ">

<div class='form-group col'>
		{{Form::label('qty_order', 'Quantity:')}}
		{{Form::text('qty_order','',  array('id'=> 'quantity','class' => 'form-control','required'))}}
         </div>

<div class='form-group col'>
        {{Form::label('date_due', 'Date Due:')}}
        {{Form::Date('date_due','',  array('class' => 'form-control'))}}
         </div>

<div class='form-group col '>
        {{Form::label('priority', 'Priority:')}}
        {{Form::text('priority','100',  array('class' => 'form-control'))}}
         </div>

<div class='form-group col'>
        {{Form::label('batch_size', 'Batch_Size:')}}
        {{Form::text('batch_size','',  array('class' => 'form-control','required'))}}
         </div>

</div>




<div class="form-row col-md-12">

<div class="col">

 	    <div class='form-group'>
        {{Form::label('description', 'Description:')}}
        {{Form::text('description','',  array('class' => 'form-control'))}}
         </div>

 	  <div class='form-group'>
        {{Form::label('notes', 'Order Notes:')}}
        {{Form::textarea('notes','',  array('class' => 'form-control', 'rows' => '5'))}}
         </div>

</div>


<div class="div1 col ">


<div class="form-row">
        <div class='form-group col-md-6'>
        {{Form::label('impressions', 'Impressions:')}}
        {{Form::text('impressions','',  array('id'=> 'impressions','class' => 'form-control','readonly' => 'true'))}}
         </div>

        <div class='form-group col-md-6'>   
        {{Form::label('finish', 'Finish:')}}
        {{Form::text('finish','', array('class' => 'form-control','readonly' => 'true'))}}
        </div>

    </div>


<div class="form-row">
        <div class='form-group col-md-6'>
        {{Form::label('punch', 'Punch Count:')}}
        {{Form::text('punch','',  array('class' => 'form-control','readonly' => 'true'))}}
         </div>
        


     
         <div class='form-group col-md-6'>
        {{Form::label('binding', 'Binding:')}}
        {{Form::text('binding','',  array('class' => 'form-control','readonly' => 'true'))}}
         </div>

</div>
<div class="form-row">

         <div class='form-group col-md-6'>
        {{Form::label('duplex', 'Duplex:')}}
        {{Form::text('duplex','',  array('class' => 'form-control','readonly' => 'true'))}}
         </div>



         <div class='form-group col-md-6'>
       <b> {{Form::label('imp_ordered', 'Impressions Ordered:')}}</b>
        {{Form::text('imp_ordered','',  array('id'=> 'imp_ordered','class' => 'form-control','style'=>'font-weight: bold','readonly' => 'true'))}}
         </div>



</div>

</div>  


</div>


</div>









</div>
</div>
</div>



{!! Form::close() !!}



      
       
<script>


//HIDE SHOW FIELDS
//$('.form-div2, .form-div3, .form-div4, .form-div5').show();


//$('.divDisc, .divCombo').hide();


var target = $('#type option:selected').text();

if(target == "Book")
    $('.divDisc, .divCombo').hide();
else if (target == "Disc")
    $('.divBook, .div1, .divCombo').hide();
else if (target == "Combo")
    $('.divDisc, .divBook, .div1').hide();







$('#type').change(function () {
    var selected = $('#type option:selected').text();
    $('.div1, .divBook').toggle(selected == "Book");
     $('.divDisc').toggle(selected == "Disc");
      $('.divCombo').toggle(selected == "Combo");

      if(selected == "Book")
 var ID = $('select[name="sku2"]').val();
else if (selected == "Disc")
    var ID = $('select[name="sku3"]').val();
else if (selected == "Combo")
    var ID = $('select[name="sku4"]').val();



 
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                            $('input[name="impressions"]').val(value['impressions']);
                            $('input[name="finish"]').val(value['finish']);
                            $('input[name="binding"]').val(value['binding']);
                            $('input[name="duplex"]').val(value['duplex']);
                            $('input[name="batch_size"]').val(value['batch_size']);
                            $('input[name="punch"]').val(value['punch']);
                        });
                       var total=isNaN(parseInt(qty.val()* $("#impressions").val())) ? 0 :(qty.val()* $("#impressions").val())
                         $("#imp_ordered").val(numberWithCommas(total));

                    }
                });
            }

});





 </script>





<script>
// SELECT PICKER JSCRIPT
$(document).ready(function() { $('.js-example-basic-single').select2({});});
</script>





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

    

var targetLoad = $('#type option:selected').text();

if(targetLoad == "Book")
     {var ID = $('select[name="sku2"]').val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                            $('input[name="impressions"]').val(value['impressions']);
                            $('input[name="finish"]').val(value['finish']);
                            $('input[name="binding"]').val(value['binding']);
                            $('input[name="duplex"]').val(value['duplex']);
                            $('input[name="batch_size"]').val(value['batch_size']);
                            $('input[name="punch"]').val(value['punch']);
                        });
                       var total=isNaN(parseInt(qty.val()* $("#impressions").val())) ? 0 :(qty.val()* $("#impressions").val())
                         $("#imp_ordered").val(numberWithCommas(total));

                    }
                });
            }}
else if (targetLoad == "Disc")
   { var ID = $('select[name="sku3"]').val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                        $('input[name="batch_size"]').val(value['batch_size']);
                           
                        });
                     
                    }
                });
            }}
else if (targetLoad == "Combo")
    {var ID = $('select[name="sku4"]').val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                        $('input[name="batch_size"]').val(value['batch_size']);
                           
                        });
                     
                    }
                });
            }}


     //AUTOFILL SCRIPT
        $('select[name="sku2"]').on('change', function() {
            var ID = $(this).val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                     	 $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                            $('input[name="impressions"]').val(value['impressions']);
                            $('input[name="finish"]').val(value['finish']);
                            $('input[name="binding"]').val(value['binding']);
                            $('input[name="duplex"]').val(value['duplex']);
                            $('input[name="batch_size"]').val(value['batch_size']);
                            $('input[name="punch"]').val(value['punch']);
                        });
                       var total=isNaN(parseInt(qty.val()* $("#impressions").val())) ? 0 :(qty.val()* $("#impressions").val())
                         $("#imp_ordered").val(numberWithCommas(total));

                    }
                });
            }else{
               
            }
        });

   $('select[name="sku3"]').on('change', function() {
            var ID = $(this).val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                        $('input[name="batch_size"]').val(value['batch_size']);
                           
                        });
                     
                    }
                });
            }else{
               
            }
        });

      $('select[name="sku4"]').on('change', function() {
            var ID = $(this).val();
            if(ID) {
                $.ajax({
                    url: '/orders/ajax/'+ID,
                    cache : false,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                                           
                         $.each(data, function(key, value) {
                            //$('select[name="city"]').append('<option value="'+ key +'">'+ value + key +'</option>');
                            //$('#test').append(value); //JQUERY ACTIONS append . prepend . etc

                        $('input[name="batch_size"]').val(value['batch_size']);
                           
                        });
                     
                    }
                });
            }else{
               
            }
        });




    });








 </script>














@endsection