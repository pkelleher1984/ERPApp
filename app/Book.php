<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];//


public function StockItem(){
        return $this->belongsToMany('App\StockItem','item_id','id');
    }



  public function RefBinding(){
        return $this->hasone('App\RefBinding','id','binding_id');
    }

  public function RefFinish(){
        return $this->hasone('App\RefFinish','id','finish_id');
    }

}
