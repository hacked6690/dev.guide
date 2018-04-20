<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'contents';

    protected $fillable = [
    	'language_id',
    	'translate_of',
    	'slug',
    	'title',
    	'excerpt',
    	'description',
    	'content_type',
    	'content_status',
    	'content_password',
    	'content_parent',
    	'viewed',
    	'shared',
    	'favorited',
    ];
}
