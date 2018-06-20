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
    public static function getRoleName($role_id){
        $role=UserRoles::where('id','=',$role_id)->first();
       return $role->slug;

    }
    public static function getRoleID($role_name){
         $role=UserRoles::where('slug','=',$role_name)->first();
       return $role->id;
    }
}
