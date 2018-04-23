


      <div class="row">
        <div class="col-md-12">
          <div class="tile">
<br>



<button id="show" class='form-control xs' style="width:92%; margin:10 40 0 15">Actions Log</button> 

<div class="table-responsive" style="padding:5 15 15 15" id="table">
          
@if(!empty($log))    

            <table class="table table-striped table-sm" style="font-size: 11">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Log</th>
               
                 
                </tr>
              </thead>
              <tbody>
               

                    @for($i = 0; $i < count($log); $i++)
<tr>
                  <td>{{$log[$i]['created_at']}}</td>
                  <td>{{$log[$i]['logtext']}}</td>
            </tr>     
                 @endfor
               
               
              </tbody>
            </table>
        
<button id="hide" class='form-control xs' >Hide Log</button>
        </div>
@endif

<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#table").hide();
       
    });
    $("#show").click(function(){
        $("#table").show();
            });

     
});
</script>

</div></div></div>