<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
  protected $fillable = [
    'user_id',
    'name',
    'n_rooms',
    'n_beds',
    'n_bath',
    'description',
    'mq',
    'long',
    'lat',
    'address',
    'path'
  ];

  public function stats(){
    return $this->hasMany('App\Stat');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function message(){
    return $this->belongsTo('App\Message');
  }

  public function sponsors(){
    return $this->hasMany('App\Sponsor');
  }

  public function services(){
    return $this->belongsToMany('App\Service');
  }
}
