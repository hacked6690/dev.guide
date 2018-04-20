<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
	protected $table = 'privileges';

	protected $fillable = [
    	'slug',
    	'title',
    	'parent',
    	'description',
    ];

    public function roles()
    {
    	return $this->belongsToMany('App\UserRoles', 'user_privileges', 'privilege_id', 'role_id');
    }
}
