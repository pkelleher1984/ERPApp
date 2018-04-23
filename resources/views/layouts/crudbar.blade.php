


 <div class="col-md-4" >

 <p class="bs-component" style="margin-top:28px; ">

 	@if(in_array($order->status, array('Planned','Active','Hold'), true ))
                      
                      {{ link_to_route('orders.edit','Edit',$order,['class'=>'btn btn-info']) }} 
	@endif

	@if(in_array($order->status, array('Planned','Hold'), true ))

                      {{ link_to_route('status.activate','Activate',$order,['class'=>'btn btn-success']) }} 

    @endif

	@if(in_array($order->status, array('Active'), true ))

                    {{ link_to_route('status.hold','Hold',$order,['class'=>'btn btn-warning']) }} 

	@endif
    
    @if(in_array($order->status, array('Planned'), true ))
    
                    {{ link_to_route('orders.destroy','Delete',$order,['class'=>'btn btn-danger','data-toggle'=>'modal', 'data-target'=>'#5']) }} 

	@endif

    </p>




         
</div>  

  
<!-- Modal -->






          





