<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutItemTranslates extends Model
{
    protected $fillable = [
    	'item_id',
    	'language_id',
    	'title',
    	'options',
    ];
}
