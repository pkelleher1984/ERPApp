

<div class="modal fade" id="6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title center" id="exampleModalLongTitle"><center>Alert</center></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
Are you sure you want to delete stock item #{{$stockItem->id}} ?
              </div>
      <div class="modal-footer">
        
        {!!Form::open(array('route'=>['stockitems.destroy',$stockItem->id],'method'=>'DELETE', 'style'=>'margin: 1px 1px 1px 1px'))!!}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>  