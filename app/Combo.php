<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $guarded = [];//


public function StockItem(){
        return $this->belongsToMany('App\StockItem','item_id','id');
    }//
} //

