<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ContentTaxonomy extends Model
{
	public $timestamps = false;
	
    protected $table = 'content_taxonomy';

    protected $fillable = [
    	'term_id',
    	'taxonomy',
    	'description',
    	'parent',
    ];
}
