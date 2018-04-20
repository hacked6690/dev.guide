<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentTermMetas extends Model
{
    public $timestamps = false;

    protected $table = 'content_termmeta';

    protected $fillabled = [
    	'term_id',
    	'meta_key',
    	'meta_value',
    ];
}
