<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPrivileges extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
    	'role_id',
    	'privilege_id',
    ];
}
