<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
  protected $fillable = [
    'sponsor_id',
    'name',
    'price',
    'duration'
  ];

  public function sponsors() {
    return $this->hasMany('App\Sponsor');
  }
}
