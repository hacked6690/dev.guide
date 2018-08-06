<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use File;
use Image;

use App\User;
use App\UserRoles;
use App\Privileges;
use App\UserMetas;
use App\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class UserAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->authorized('user_accounts')) {
            abort(403, 'Unauthorized action.');
        }

    


        $display = Input::has('display') ? Input::get('display') :7;

        /*$user_accounts = DB::table('users')
                            ->select(
                                'users.id',
                                'user_roles.title as role',
                                'users.email',
                                'users.created_at',
                                'users.updated_at',
                                DB::raw('concat(\'{\', group_concat(\'"\', user_meta.meta_key, \'":"\', user_meta.meta_value, \'"\' ORDER BY user_meta.meta_key ASC), \'}\') as obj')
                            )
                            ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
                            ->leftJoin('user_meta', 'users.id', '=', 'user_meta.user_id')
                            ->groupBy('users.id')
                            ->orderBy('users.created_at', 'desc')
                            ->paginate($display);*/

        // decode obj json ___
        $users = array();

      /*  foreach ($user_accounts as $key => $value)
        {
            
            $usr = json_decode($value->obj);

            $key = (object) array(
                        'id' => $value->id,
                        'role' => $value->role,
                        'name' => $usr->name,
                        'email' => $value->email,
                        'phone' => $usr->phone,
                        'created_at' => $value->created_at,
                        'updated_at' => $value->updated_at
                    );
         
            array_push($users, $key);
      
        }*/
        $role_mot = UserRoles::getRoleID('mot');
        $role_admin = UserRoles::getRoleID('admin');
        if(User::getUserLogin()=='mot'){             
             $arr_roles=array($role_mot);
        }
        if(User::getUserLogin()=='admin'){
             $arr_roles=array($role_mot,$role_admin);
        }
        $users = User::with('user_metas')
             ->whereIn('role_id',$arr_roles)
              ->orderBy('id','desc')
              ->paginate($display);
    // dd($users);

        return view('user_accounts.index', compact(['users', 'display']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!Auth::user()->authorized('create_user_account')) {
            abort(403, 'Unauthorized action.');
        }

        if(User::getUserLogin()=='mot'){$user_roles = UserRoles::whereIn('slug',array('mot'))->get();}
        if(User::getUserLogin()=='admin'){$user_roles = UserRoles::whereIn('slug',array('mot','admin'))->get();}
      
        return view('user_accounts.create', compact('user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_user_account')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'role_id' => 'required|numeric',
                'profile' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
                'name' => 'required',
                'phone' => 'nullable|regex:/^(?=.*[0-9])[- +()0-9]+$/',
                'email' => 'required|max:64|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

        if($validator->fails())
        {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        // Required - hash password before stored
        $request->merge(['password' => Hash::make($request->input('password'))]);

        // decrypted role_id, cause encrypted at frontend
        $user = new User([
                'role_id' => $request->input('role_id'),
                'email' => $request->input('email'),
                'name' => $request->name,
                'password' => $request->input('password'),
                'remember_token' => $request->input('_token'),
            ]);

        $user->save();

        // store user meta if inputed ____
        $default = array('profile', 'name', 'phone');

        foreach ($request->all() as $key => $value)
        {
            if(in_array($key, $default))
            {
                $valued = $value;

                if($key =='profile')
                {
                    // store profile ;
                    $request->profile->store($user->id, 'public');

                    $profile_dir = storage_path('app/public/'. $user->id .'/profile');

                    if(!File::exists($profile_dir))
                    {
                        File::makeDirectory($profile_dir);
                    }

                    Image::make($request->profile->getRealPath())->fit(120)->save($profile_dir .'/'. $request->profile->hashName());

                    $valued = $request->profile->hashName();
                }

                $user_meta = new UserMetas([
                        'user_id' => $user->id,
                        'meta_key' => $key,
                        'meta_value' => $valued
                    ]);

                $user_meta->save();
            }
        }

        return redirect('user_accounts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAccounts  $userAccounts
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_user_account')) {
            abort(403, 'Unauthorized action.');
        }

        // $user_roles = UserRoles::all();
         if(User::getUserLogin()=='mot'){$user_roles = UserRoles::whereIn('slug',array('mot'))->get();}
        if(User::getUserLogin()=='admin'){$user_roles = UserRoles::whereIn('slug',array('mot','admin'))->get();}

        $decrypted_id = decrypt($encrypted_id);

        $user_meta = \Helper::metas('user_meta', ['user_id' => $decrypted_id]);

        $profile = isset($user_meta->profile) ? Storage::url($decrypted_id .'/profile/'. $user_meta->profile->value) : '/assets/admin/img/avatars/male.png';

        $user = User::select('id', 'role_id', 'email', 'created_at')->where('id', $decrypted_id)->first();

        return view('user_accounts.edit', compact(['user_roles', 'user', 'user_meta', 'profile']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAccounts  $userAccounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_user_account')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'role_id' => 'required|numeric',
                'profile' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
                'name' => 'required',
                'phone' => 'nullable|regex:/^(?=.*[0-9])[- +()0-9]+$/',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        // update role __
        $user = User::find($decrypted_id);
        $user->role_id = $request->input('role_id');
        $user->save();

        // update metas +
        $meta = array(
                'name' => $request->input('name'),
                'phone' => $request->input('phone')
            );
        $excepts = ['profile'];

        if($request->file('profile') !=null)
        {
            $request->profile->store($decrypted_id, 'public');

            $profile_dir = storage_path('app/public/'. $decrypted_id .'/profile');

            if(!File::exists($profile_dir))
            {
                File::makeDirectory($profile_dir);
            }

            // store fit profile ;
            Image::make($request->profile->getRealPath())->fit(120)->save($profile_dir .'/'. $request->profile->hashName());

            $meta['profile'] = $request->profile->hashName();

            $excepts =[];
        }

        \Helper::store_meta('user_meta', ['user_id' => $decrypted_id], $meta, $excepts, false);

        Session::flash('updated', 'User profile is updated');

        return redirect()->route('user_accounts.edit', $encrypted_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAccounts  $userAccounts
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_user_account')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $user = DB::table('users')->where('id', $decrypted_id)->limit(1);
        $user->delete();

        $user_meta = UserMetas::where('user_id', $decrypted_id);
        $user_meta->delete();

        Session::flash('deleted', "User is deleted");

        return redirect('user_accounts');
    }
}
