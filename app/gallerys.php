<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallerys extends Model
{

    protected $table="gallerys";
  protected $fillable = [
      'name',
      'gtype',
      'description',
      'image',
      'status'
    ];
}
