<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = array('name','position','image','text');
    protected $table = 'peoples';
}
