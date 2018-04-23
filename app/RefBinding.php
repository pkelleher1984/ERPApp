<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefBinding extends Model
{
   protected $guarded = [];
       public $timestamps = false; //

    public function Book()
    
    {
      return $this->belongsToMany('App\Book','id','binding_id');
    }



}
