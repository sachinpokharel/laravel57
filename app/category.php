<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table="categorys";
  protected $fillable = [
      'name',
      'description',
      'image',
      'status'
    ];
}
