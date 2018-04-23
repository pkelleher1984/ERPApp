
@extends('_layouts.master')


@section('content')

 <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    
             </div>   
           </div>
           
 <div class="row">
  <div class="col-md-12">
<div class='tile'>
<table class="table table-striped dark">
  <thead class="thead-dark">
  	 <tr>
      <th scope="col" colspan="5" style="background: #142E54;"><center><h5><i class="app-menu__icon fa fa-book" style="margin-bottom:5px"></i> Books</h5></center></th>
    
    </tr>

    </thead>

    <thead>
    <tr>
      <th scope="col"><small>(in impressions)</small></th>
           <th scope="col"><h6>Activated</h6></th>
      <th scope="col"><h6>Remaining</h6></th>
       <th scope="col"><h6>Planned</h6></th>
      <th scope="col"><h6>Total Pipeline</h6></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><h5>All</h5></th>
          <td>{{number_format($sum_stats['active_ordered'][0])}}</td>
      <td>{{number_format($sum_stats['active_ordered'][0]-$sum_stats['active_complete'][0])}}</td>
     
        <td>{{number_format($sum_stats['planned'][0])}}</td>
         <td>{{number_format($sum_stats['active_ordered'][0]-$sum_stats['active_complete'][0]+$sum_stats['planned'][0])}}</td>
    </tr>

  </tbody>
</table>
</div></div></div>



 <div class="row">
  <div class="col-md-6">
<div class='tile'>
<table class="table table-striped dark" >
  <thead class="thead-dark">
  	 <tr>
      <th scope="col" colspan="5" style="background: #4C668C"><center><h5><i class="app-menu__icon fa fa-dot-circle-o" style="margin-bottom:5px"></i> Discs</h5></center></th>
    
    </tr>

    </thead>

    <thead>
    <tr>
      <th scope="col"><small>(in units)</small></th>
              <th scope="col"><h6>Activated</h6></th>
      <th scope="col"><h6>Remaining</h6></th>
       <th scope="col"><h6>Planned</h6></th>
      <th scope="col"><h6>Total Pipeline</h6></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><h5>All</h5></th>
       <td>{{number_format($sum_stats['discs_active'])}}</td>
      <td>{{number_format($sum_stats['discs_active']-$sum_stats['discs_complete'])}}</td>
     
        <td>{{number_format($sum_stats['discs_planned'])}}</td>
         <td>{{number_format($sum_stats['discs_active']-$sum_stats['discs_complete']+$sum_stats['discs_planned'])}}</td>
    </tr>
   
  </tbody>
</table>
</div>
</div>

 <div class="col-md-6">
<div class='tile'>
<table class="table table-striped dark">
  <thead class="thead-dark">
  	 <tr>
      <th scope="col" colspan="5" style="background: #758AA8"><center><h5><i class="app-menu__icon fa fa-archive" style="margin-bottom:5px"></i> Combos</h5></center></th>
    
    </tr>

    </thead>

    <thead>
    <tr>
      <th scope="col"><small>(in units)</small></th>
           <th scope="col"><h6>Activated</h6></th>
      <th scope="col"><h6>Remaining</h6></th>
       <th scope="col"><h6>Planned</h6></th>
      <th scope="col"><h6>Total Pipeline</h6></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><h5>All</h5></th>
 <td>{{number_format($sum_stats['combos_active'])}}</td>
      <td>{{number_format($sum_stats['combos_active']-$sum_stats['combos_complete'])}}</td>
     
        <td>{{number_format($sum_stats['combos_planned'])}}</td>
         <td>{{number_format($sum_stats['combos_active']-$sum_stats['combos_complete']+$sum_stats['combos_planned'])}}</td>
    </tr>
   
  </tbody>
</table>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-12">
<div class='tile'>

<table class="table table-striped dark" style="width:100%">
  <thead class="thead-dark">
  	 <tr>
      <th scope="col" colspan="5" style="background: #2C4770"><center><h5><i class="app-menu__icon fa fa-send-o" style="margin-bottom:5px"></i> Current Tasks</h5></center></th>
    
    </tr>

    </thead>

    <thead>
    <tr>
      
           <th scope="col"><h6>Task</h6></th>
      <th scope="col"><h6>Units</h6></th>
       <th scope="col"><h6>Impressions</h6></th>
    
    </tr>
  </thead>
  <tbody>
 
   <tr>
      <th scope="row"><h5>Print <small>(Books)</small></h5></th>
      <td>{{$sum_stats['print_units']}}</td>
      <td>{{ (!empty($sum_stats['print_imps'][0])) ? number_format($sum_stats['print_imps'][0]) : '0'}}</td>
    </tr>
    <tr>
      <th scope="row"><h5>Bind <small>(Books)</small></h5></th>
      <td>{{$sum_stats['bind_units']}}</td>
      <td>{{ (!empty($sum_stats['bind_imps'][0])) ? number_format($sum_stats['bind_imps'][0]) : '0'}}</td>
    </tr>
    <tr>
      <th scope="row"><h5>Box <small>(Books)</small></h5></th>
      <td>{{$sum_stats['box_units']}}</td>
      <td>{{ (!empty($sum_stats['box_imps'][0])) ? number_format($sum_stats['box_imps'][0]) : '0'}}</td>
     </tr>

        <tr>
      <th scope="row"><h5>Build <small>(Discs & Combos)</small></h5></th>
      <td>{{$sum_stats['build_units']}}</td>
      <td>NA</td>
    
    </tr>
  </tbody>
</table>

</div></div></div>



    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Printer', 'Impressions'],
          ['Digi 1',     11],
          ['Digi 2',      2],
          ['Digi 3',  2],
          ['Digi 4', 2],
          
        ]);

        var options = {
          title: 'Printer Usage Last 7 Days ',
  

          pieHole: 0.4,
          colors: ['#758AA8', '#4C668C', '#142E54', '#051A38']
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
 






 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Print', 'Bound', 'Boxed'],
          ['-3 Weeks', 1000, 400, 200],
          ['-2 Weeks', 1170, 460, 250],
          ['Last Week', 660, 1120, 300],
          ['Current', {{$sum_stats['build_units']}}, 540, 350]
        ]);

        var options = {
        	 colors: ['#758AA8', '#4C668C', '#142E54', '#051A38'],
          chart: {
            title: 'Operations Performance',
            subtitle: 'Last Seven Days Activity',


          }
    
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <div id="columnchart_material" style="width: 50%; height: 500px;"></div>


   <div id="donutchart" style="width: 100%; height: 500px;"></div>






    <div id="chart_div" style="width: 100%; height: 500px;"></div>


 --}}



</html>

@endsection



