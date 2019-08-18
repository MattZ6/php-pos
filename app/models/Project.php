<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'name', 'description',
  ];

  public function tasks(){
    return $this->hasMany('App\Task');
  }
}
