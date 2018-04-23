
@extends('_layouts.master')


@section('content')


@section('content')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>






<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>




<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text"></i> Reports</h1>
             </div>   




{{ Form::open(array('url' => '/reports', 'method' => 'post'))}}



</div>






<div class="row">
        <div class="col-md-12">
          <div class="tile">


<div class="form-row col-md-12 ">






<div class='form-group col'>
		{{Form::label('sku', 'SKU:')}}
		{{Form::text('sku','',  array('id'=> 'quantity','class' => 'form-control'))}}
</div>

		<div class='form-group col'>
        {{Form::label('date1', 'From date 1:')}}
        {{Form::Date('date1','',  array('class' => 'form-control'))}}
         </div>

         <div class='form-group col'>
        {{Form::label('date2', 'to date 2 (Up to but not including):')}}
        {{Form::Date('date2','',  array('class' => 'form-control'))}}
         </div>


 <div class="bs-component" style="margin-top:28px; ">
 <button type="submit" class="btn btn-primary btn">Search</button>
</div>


</div>


{!! Form::close() !!}





</div>

</div></div>


@if( ! empty($results))

<div class="row">

<?php $sumStats=get_object_vars($sumStats[0]); ?>
        <div class="col-md-6 col-lg-3">
          <div class="alert alert-dismissible alert-warning">
            <div class="info">
              <button class="close" type="button" data-dismiss="alert">×</button>
              <h4><b>Total Orders:</b> </h4>
              <p><b>{{number_format($sumStats['count'])}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="alert alert-dismissible alert-warning">
            <div class="info">
               <button class="close" type="button" data-dismiss="alert">×</button>
              <h4><b>Total Items Produced:</b> </h4>
              <p><b>{{number_format($sumStats['totItems'])}} </b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="alert alert-dismissible alert-warning">
            
               <button class="close" type="button" data-dismiss="alert">×</button>
              <h4><b>Total Impressions: </b></h4>
              <p><b>{{number_format($sumStats['totImps'])}}</b> <i>(Does not include Discs & Combos)</i></p>
            
          </div>
        </div>
</div>


<div class="row">
        <div class="col-md-12">
          <div class="tile">


<?php  

$columns=array_keys(get_object_vars($results[0]));  ?>




 
<table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%" id="results" style="font-size: 12;">


<thead>
 <tr>  

  <th></th>
  @for ($i=0; $i<sizeof($columns); $i++)

  <th>{{ucwords($columns[$i])}}</th>

  @endfor


</tr>

</thead>


<tbody> 


 
  @for ($i=0; $i<count($results); $i++)
<tr>
 <?php 
  $data=array_values(get_object_vars($results[$i])); 
    $id=$data[1];
  ?>

<td></td>

 

  @for ($j=0; $j<sizeof($data); $j++)


   <td> {{$data[$j]}}</td>
  @endfor 

</tr>

@endfor

</tbody>

</table> 

@endif

</div>
</div>
</div>

<script type="text/javascript">$(document).ready(function (){
    var table = $('#results').DataTable({
         
       
             dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
       "lengthChange": false,
       "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
       "iDisplayLength": 50,
       "aaSorting": [],
    });
    
    $('#status').on('change', function(){
       table.search(this.value).draw();   
    });

  $('#type').on('change', function(){
       table.search(this.value).draw();   
    });


});


</script>



@endsection