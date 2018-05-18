<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public  $table='users';
    protected $fillable = [
        'role_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\UserRoles', 'role_id', 'id');
    }

    public function authorized($privilege =null)
    {
        if(is_null($privilege))
            return false;

        $privileges = $this->role->privileges->pluck('slug');

        return in_array($privilege, $privileges->toArray());
    }

     // 
    public function user_metas() {
        return $this->hasMany('App\UserMetas', 'user_id');
    }

}
