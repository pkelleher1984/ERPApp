<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefStockItemType extends Model
{
      

protected $guarded = [];
       public $timestamps = false;



public function StockItem()
    
    {
      return $this->belongsToMany('App\StockItem','id','prodType_id');
    }


 //
}
