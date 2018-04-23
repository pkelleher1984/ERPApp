<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       

     protected $guarded = [];//
     


     public function stockItem()
     {
        return $this->hasone('App\StockItem','id','item_id');
    }


    public function Task()
    
    {
      return $this->hasMany('App\Task','order_id','id');
    }

    

 }
