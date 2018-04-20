<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
    	'slug',
    	'title',
    	'description',
    	'options'
    ];

    public function users()
    {
    	return $this->hasMany('App\User', 'role_id', 'id');
    }

    public function privileges()
    {
    	return $this->belongsToMany('App\Privileges', 'user_privileges', 'role_id', 'privilege_id');
    }
}
