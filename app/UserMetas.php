<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMetas extends Model
{
	protected $table = 'user_meta';

    protected $fillable = [
    	'user_id',
    	'meta_key',
    	'meta_value',
    ];
    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function user() {
        return $this->belongsTo('App\User');
    }
}
