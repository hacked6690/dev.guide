<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $fillable = [
    	'slug',
    	'title',
    	'priority',
    	'set_default',
    	'icon',
    	'options',
    ];
}
