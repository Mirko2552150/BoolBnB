<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    'home_id',
    'body',
    'mail'
  ];

  public function homes(){
    return $this->hasMany('App\Home');
  }

}
