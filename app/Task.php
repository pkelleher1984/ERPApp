<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];//


 public function Order()
    
    {
      return $this->belongsTo('App\Order','order_id','id');
    }

}
