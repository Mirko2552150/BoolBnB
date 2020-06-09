<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $fillable = [
    'home_id',
    'expired'
  ];

  public function home(){
    return $this->belongsTo('App\Home');
  }

  public function sponsorType(){
    return $this->belongsTo('App\SponsorType');
  }
}
