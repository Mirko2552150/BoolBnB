<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
  protected $fillable = [
    'name',
    'price',
    'duration'
  ];

  public function sponsor(){
    return $this->hasMany('App\Sponsor');
  }

}
