@extends('_layouts.master')




@section('content')
 <meta http-equiv="refresh" content="60"/>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>


<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <div class="app-title">
        <div>
          <h1><i class="fa fa-database"></i> Stock Items: {{ucwords($itemSlug."s")}}</h1>
    
             </div>   



             
          <ul class="app-breadcrumb breadcrumb">
        @if(!Auth::guest() && Auth::user()->admin==1)

          {{ link_to_route('stockitems.create','Create New Stock Item',['type'=>$itemSlug],['class'=>'btn btn btn-success','style'=>'margin-right:10']) }} 
       
        @endif
        </ul>

</div>


@if( ! empty($stockItems))

<div class="row">
        <div class="col-md-12">
          <div class="tile">


 @if(Session::has('message'))

<div class='alert alert-success' style="height: 50; margin-top: 15">{{Session::get('message')}}</div>
@endif

<?php $columns=array_keys($stockItems[0]); ?>





 
<table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%" id="stockItems" style="font-size: 14;">


<thead>
 <tr >

  <th></th>
  @for ($i=0; $i<sizeof($columns); $i++)



  <th>{{ucwords($columns[$i])}}</th>



  @endfor


</tr>

</thead>


<tbody> 


 
  @for ($i=0; $i<count($stockItems); $i++)
<tr onMouseOver="this.style.cursor='hand'">
 <?php 
  $data=array_values($stockItems[$i]); 
    $id=$data[0];
  ?>

<td></td>

 

  @for ($j=0; $j<sizeof($data); $j++)


 <td onclick="window.location='/stockitems/{{$id}}'"> {{$data[$j]}}</td>
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
    var table = $('#stockItems').DataTable({

      stateSave: true,
      "pageLength": 25,  
      "columnDefs": [
            { "targets": [1], "visible": false,"searchable": false},
            { "targets": [5,6], "searchable": false}

            ],
         

    });
    
   


});


</script>






@endsection