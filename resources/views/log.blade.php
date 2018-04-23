
@extends('_layouts.master')


@section('content')

 <div class="app-title">
        <div>
          <h1><i class="fa fa-cogs"></i> Control Panel</h1>
   
             </div>   
           </div>


      <div class="row">
        <div class="col-md-12">
          <div class="tile">
<br>



{{-- <button id="show" class='form-control xs' style="width:92%; margin:10 40 0 15">Actions Log</button> 
 --}}
          
@if(!empty($log))    

            <table class="table table-striped table-sm" style="font-size: 14; ">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Log</th>
               
                 
                </tr>
              </thead>
              <tbody>
               

                    @for($i = 0; $i < count($log); $i++)
<tr>

                  <td>{{$log[$i]['created_at']->timezone('America/Chicago')->format('D F j, Y, g:i a')}}</td>
                  <td>{{$log[$i]['logtext']}}</td>
            </tr>     
                 @endfor
               
               
              </tbody>
            </table>
        
{{-- <button id="hide" class='form-control xs' >Hide Log</button>
 --}}        </div>
@endif

{{-- <script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#table").hide();
       
    });
    $("#show").click(function(){
        $("#table").show();
            });

     
});
</script>
 --}}
</div></div></div>

@endsection

