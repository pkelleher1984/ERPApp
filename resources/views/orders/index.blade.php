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
          <h1><i class="fa fa-file-text"></i> Orders: {{$type}}s </h1>
         
             </div>   



             
          <ul class="app-breadcrumb breadcrumb">
        
          
@if(!Auth::guest() && Auth::user()->admin==1)

          {{ link_to_route('orders.create','Create New Order',['type'=>$type],['class'=>'btn btn btn-success','style'=>'margin-right:10']) }} 
@endif        
        </ul>
     

      </div>







@if($type=='Book')


 <div class="row">


        <div class="col-md-6 col-lg-3">
          <div class="alert alert-dismissible alert-warning">
            <div class="info">
              <button class="close" type="button" data-dismiss="alert">×</button>
              <h4 ><b>Active Impressions</b> </h4>
              <p>Ordered: <b>{{number_format($sum_stats['active_ordered'][0])}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="alert alert-dismissible alert-warning">
            <div class="info">
               <button class="close" type="button" data-dismiss="alert">×</button>
              <h4><b>Active Impressions</b> </h4>
              <p>Remaining: <b>{{number_format($sum_stats['active_ordered'][0]-$sum_stats['active_complete'][0])}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="alert alert-dismissible alert-warning">
            
               <button class="close" type="button" data-dismiss="alert">×</button>
              <h4><b>Planned Impressions</b></h4>
              <p><b>{{number_format($sum_stats['planned'][0])}}</b></p>
            
          </div>
        </div>
</div>


@endif

@include('_layouts.orders')



@endsection