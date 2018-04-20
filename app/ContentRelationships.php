<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentRelationships extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
    	'object_id',
    	'taxonomy_id',
    	'term_order',
    ];
}
