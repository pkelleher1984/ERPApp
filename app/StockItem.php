<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $guarded = [];//


   public function Book()
    
    {
      return $this->hasone('App\Book','item_id','id');
    }

public function Disc()
    
    {
      return $this->hasone('App\Disc','item_id','id');
    }



  public function Combo()
    
    {
      return $this->hasone('App\Combo','item_id','id');
    }


   public function RefStockItemType()
    
    {
      return $this->hasone('App\RefStockItemType','id','prodType_id');
    }



    public function Order()
    
    {
      return $this->belongsToMany('App\Order','id','item_id');
    }
//
}
