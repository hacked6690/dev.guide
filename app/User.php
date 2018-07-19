<?php

namespace App;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserRoles;
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
        'role_id', 'email', 'password','remember_token','creator_id',
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

    public function guide_price(){
        return $this->hasMany('App\GuidePrice', 'guide_id');
    }
    public static function getUserLogin(){
        $user_login='visitor';
        if(Auth::check()){
            if(Auth::user()->id!=null){
                $user_login=UserRoles::getRoleName(Auth::user()->role_id);
            }
        }
        return $user_login;
    }
}
