<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
  protected $fillable = [
    'home_id'
  ];

  public function home(){
    return $this->belongsTo('App\Home');
  }

}
