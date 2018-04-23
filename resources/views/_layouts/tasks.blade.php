
@if (count($tasks)>0)


  

@endif    
@if(Session::has('message'))




<div class='alert alert-success' style="height: 50; margin-top: 15">{{Session::get('message')}}</div>


@endif




@if (($action=='Bind'||$action=='Box') && !empty($sumStats))

    <div class="row">
          
          <div class="col-md-12">

                <div class="tile">


               

<table class="table table-hover  dt-responsive col-md-12" cellspacing="0" id="sumstats"  style="font-size: 14;">
<thead>
 
 <?php  $sumColumns=array_keys(get_object_vars($sumStats[0])); ?>
  
  <tr>
    @for ($i=0; $i<sizeof($sumColumns); $i++)

  <th >{{ucwords($sumColumns[$i])}}</th>

    @endfor

</tr>

</thead>
  
<tbody>

   @for ($i=0; $i<count($sumStats); $i++)
      <tr  onMouseOver="this.style.cursor='hand';">

     <?php $sumData=array_values(get_object_vars($sumStats[$i])); ?>

     @for ($j=0; $j<sizeof($sumData); $j++)
    
    <td style="padding:5 5 5 5; vertical-align: middle;">{{$sumData[$j]}}</td>
        @endfor
     
    </tr>

     @endfor

</tbody>

</table>
             
</div></div></div>


@endif














@if (count($tasks)>0)

<?php  $columns=array_keys($tasks[0]); ?>


    <div class="row">
        <div class="col-md-12">
          <div class="tile">




</script>

<table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%" id="tasks" style="font-size: 14;">


<thead>
 <tr >
<th></th>
   <th>Complete</th>
  @for ($i=0; $i<sizeof($columns); $i++)

  <th>{{ucwords($columns[$i])}}</th>

  @endfor

 
</tr>

</thead>


<tbody> 




 
  @for ($i=0; $i<count($tasks); $i++)
<tr onMouseOver="this.style.cursor='hand';" >
    

  <?php 
   $data=array_values($tasks[$i]); 
     

    $id=$data[1];
    $action=$data[3];
    $batch_size=$data[4];
    $qty_order=$data[5];
    $progress=$data[6];
    $user=$data[12];
    $resource=$data[13];


  ?>

<td  align="center" style="padding:2 5 2 5; vertical-align: middle;">  

   @if($data[0]<=10) <img src="/images/Alert.png" style="height:25px;"> @endif 


 </td> 
<td align="center" style="padding:2 5 2 5; vertical-align: middle;">


<button type="button" class="btn btn-success" style="padding:2 5 2 5;" data-toggle="modal" data-target="#{{$id}}" style="font-size:14; height: 35">
<i class="app-menu__icon fa fa-check-square" style="margin-bottom: 3px;"></i>Complete</button>



</td>

  @for ($j=0; $j<sizeof($data); $j++)



    <td onclick="window.location='/tasks/{{$id}}'" style="padding:2 5 2 5; vertical-align: middle;">{{$data[$j]}} </td>

  @endfor 











<!-- Modal -->
<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title center" id="exampleModalLongTitle"><center>Confirm</center></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      
        
        {!!Form::open(array('route'=>['task.complete',$id],'method'=>'GET', 'style'=>'margin: 1px 1px 1px 1px'))!!}
  
 
 <div class="form-row col md-6">
     <div class='form-group col md-3'>
    
    @if($action=='Print'||$action=='Build')
     {{Form::label('batch_size', 'Batch_Size:')}}
    <?php
      $max=$qty_order-$progress;
      ?>
     {{Form::number('batch_size',$batch_size,  array('class' => 'form-control', 'max' => $max , 'min' => 1))}}

    <br>
  
     {{Form::checkbox('change_def', '1')}}



{{Form::label('toggle', 'Default Size for this Order')}}

@endif
     </div>


    @if($action=='Print')
    <div class='form-group col-md-3'>
    {{Form::label('resource_id', 'Resource:', array('class' => 'label'))}}
    {{Form::select('resource_id', array('Digi_1' => 'Digi 1','Digi_2' => 'Digi 2','Digi_3' => 'Digi 3','Digi_4' => 'Digi 4'), $resource,  array('class' => 'form-control'))}} 
    </div>
@endif

    <div class='form-group col-md-3'>
    {{Form::label('user_id', 'User:', array('class' => 'label'))}}
    {{Form::select('user_id', $users, Auth::user()->id,  array('class' => 'form-control'))}} 
    </div>

</div>
<div class="modal-footer">
</div>



    
        {!! Form::button(' <i class="app-menu__icon fa fa-check-square" style="margin-bottom: 3px;"></i> Complete', ['class'=>'btn btn-success', 'type'=>'submit']) !!}
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>  








</tr>

@endfor

</tbody>

</table> 
</div></div></div>
</div>

<script type="text/javascript">



  $(document).ready(function (){







 var table = $('#tasks').DataTable({
      destroy:true,
       dom: 'lrtip',
       stateSave: true,
       "lengthChange": false,
       "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
       "iDisplayLength": 50,
       "order": [[ 2, "asc" ],[4,"asc"]],
       "aaSorting": [],
       "columnDefs": [
            {
              //hide these columns
                 "targets": [3,5,8,9,14,15],
                "visible": false,
                "searchable": false
            }
        
        ],
    });
    
  var tbl = document.getElementById("sumstats");

        if (tbl != null) {
            for (var i = 1; i < tbl.rows.length; i++) {
                for (var j = 1; j < tbl.rows[i].cells.length; j++)
                 
                   tbl.rows[i].onclick = function () { search(this); };
            }
        }

        function search(cel) {
       table.search(cel.cells[1].innerHTML).draw();   
        
        }


        function getNumFilteredRows(id){
   var info = $(id).DataTable().page.info();
   return info.recordsDisplay;
}

if(getNumFilteredRows(tasks)==0){table.search( '' ).columns().search( '' ).draw();}

});
 </script>

<script type="text/javascript">



  $(document).ready(function (){

    var table = $('#sumstats').DataTable({   

      dom: 'lrtip',
       "lengthChange": false,
       "iDisplayLength": 50,
       "order": [[ 0, "asc" ]],
       "aaSorting": [],
       "paging":   false,


   });
});





    </script>














@else
<h3>NO INCOMPLETE TASKS</h3>
@endif
