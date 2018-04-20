<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutCategories extends Model
{
    protected $fillable = [
    	'slug',
    	'title',
    	'description',
    	'options',
    ];
}
