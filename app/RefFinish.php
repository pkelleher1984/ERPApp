<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefFinish extends Model
{
    protected $guarded = [];
       public $timestamps = false;//

  public function Book()
    
    {
      return $this->belongsToMany('App\Book','id','finish_id');
    }


}
