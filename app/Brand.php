<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table = 'brands';
    public $timestamps = false;
    protected $guarded = ['id'];

}
