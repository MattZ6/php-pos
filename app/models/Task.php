<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
      'title', 'description', 'completed', 'type', 'project_id'
  ];

  public function project(){
    return $this->hasOne('App\Project');
  }
}
