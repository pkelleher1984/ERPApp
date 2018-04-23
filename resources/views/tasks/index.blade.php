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
          <h1><i class="fa fa-tasks"></i> Tasks: {{$action}} </h1>
       
        </div>

      </div>

@guest
 <div class="row">
        <div class="col-md-12">
          <div class="tile">

<h3><i class="fa fa-id-badge"></i> No User Selected</h3>
<h6>Please Login.</h6>
</div></div></div>
@else












@include('_layouts.tasks')


@endguest

@endsection