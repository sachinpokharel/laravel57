<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    protected $table="posts";
    protected $fillable = [
        'title',
        'keyword',
        'description',
        'heading',
        'shortstory',
        'fullstory',
        'category_id',
        'user_id',
        'fimage',
        'status'
    ];
}
