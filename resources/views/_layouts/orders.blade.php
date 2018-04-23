

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
@if( ! empty($orders))
<div class="form-row col-lg-9 col-md-12 col-sm-12  ">

@if($type=='Book')

         <div class='form-group col-lg-3 col-md-4 col-sm-6  '>
    {{Form::label('status', 'Status:', array('class' => 'label'))}}
    {{Form::select('status', array('' => 'All','Planned' => 'Planned','Active' => 'Active','Hold' => 'Hold'), 'All',  array('id' => 'statusb','class' => 'form-control'))}}
    </div>

@elseif($type=='Disc')

         <div class='form-group col-lg-3 col-md-4 col-sm-6  '>
    {{Form::label('status', 'Status:', array('class' => 'label'))}}
    {{Form::select('status', array('' => 'All','Planned' => 'Planned','Active' => 'Active','Hold' => 'Hold'), 'All',  array('id' => 'statusd','class' => 'form-control'))}}
    </div>

@elseif($type=='Combo')

         <div class='form-group col-lg-3 col-md-4 col-sm-6  '>
    {{Form::label('status', 'Status:', array('class' => 'label'))}}
    {{Form::select('status', array('' => 'All','Planned' => 'Planned','Active' => 'Active','Hold' => 'Hold'), 'All',  array('id' => 'statusc','class' => 'form-control'))}}
    </div>

@endif
 

</div>

 @if(Session::has('message'))

<div class='alert alert-success' style="height: 50; margin-top: 15">{{Session::get('message')}}</div>
@endif




<?php  $columns=array_keys($orders[0]);  ?>

 
<table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%" id="orders" style="font-size: 14;">


<thead>
 <tr>  

  <th></th>
  <th>Activate</th>
  @for ($i=0; $i<sizeof($columns); $i++)

  <th>{{ucwords($columns[$i])}}</th>

  @endfor


</tr>

</thead>


<tbody> 


 
  @for ($i=0; $i<count($orders); $i++)
<tr onMouseOver="this.style.cursor='hand'">
 <?php 
  $data=array_values($orders[$i]); 
    $id=$data[1];
  ?>

 <td  align="center" style="padding:2 5 2 5; vertical-align: middle;">  

   @if($data[0]<=10) <img src="/images/Alert.png" style="height:25px;"> @endif 


 </td> 
<td  align="center" style="padding:2 5 2 5; vertical-align: middle;">  
    
@if((in_array($data[4], array('Planned','Hold'), true )))
   @if(!Auth::guest() && Auth::user()->admin==1)

     <a href="/status/activate/{{$id}}">
       <button type="button" class="btn btn-success" style="padding:2 5 2 5;">
       <i class="app-menu__icon fa fa-play" style="margin-bottom: 5px"></i>Activate
    </button>      
    </a>
  
  @endif   


@else
   
       <button type="button" class="btn btn-secondary" style="padding:2 5 2 5;" disabled>
       <i class="app-menu__icon fa fa-check" style="margin-bottom: 5px"></i>Activated
    </button>      


@endif

</td>

 

  @for ($j=0; $j<sizeof($data); $j++)


    <td onclick="window.location='/orders/{{$id}}'" style="padding:2 5 2 5; vertical-align: middle;">{{$data[$j]}} </td>

  @endfor 

</tr>

@endfor

</tbody>

</table> 

</div>
</div>
</div>

<script type="text/javascript">$(document).ready(function (){
    var table = $('#orders').DataTable({
         

       dom: 'lrtip',
       "lengthChange": false,
       "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
       "iDisplayLength": 50,

       "order":  [[2,'asc']],
                    stateSave: true,

    });
    
    $('#statusb').on('change', function(){
       table.search(this.value).draw();   
    });
 $('#statusd').on('change', function(){
       table.search(this.value).draw();   
    });
 $('#statusc').on('change', function(){
       table.search(this.value).draw();   
    });



});
</script>




<script type="text/javascript">

$(function() {


     $('#statusb').change(function() {
        localStorage.setItem('statusb', this.value);
    });


   if(localStorage.getItem('statusb')){
        $('#statusb').val(localStorage.getItem('statusb'));
    }

    $('#statusd').change(function() {
        localStorage.setItem('statusd', this.value);
    });


   if(localStorage.getItem('statusd')){
        $('#statusd').val(localStorage.getItem('statusd'));
    }

    $('#statusc').change(function() {
        localStorage.setItem('statusc', this.value);
    });


   if(localStorage.getItem('statusc')){
        $('#statusc').val(localStorage.getItem('statusc'));
    }

   
});

</script>


@else
<h3>NO OUTSTANDING ORDERS</h3>

@endif