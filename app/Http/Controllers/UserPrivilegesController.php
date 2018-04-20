<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Privileges;
use App\UserRoles;
use App\UserPrivileges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserPrivilegesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($encrypted_id)
    {
        if(!Auth::user()->authorized('create_user_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $privileges = Privileges::where('parent', null)
                            ->orderBy('privileges.slug', 'asc')
                            ->get();

        $qry = DB::table('privileges')
                    ->where('privileges.parent', '<>', null)
                    ->orderBy('privileges.id', 'asc')
                    ->orderBy('privileges.parent', 'asc')
                    ->get();

        $arr_chld = collect([]);
        $tmp_chld = array();

        foreach ($qry as $key => $value)
        {
            if(!in_array($value->parent, $tmp_chld))
            {
                $tmp_chld[] = $value->parent;

                $arr_chld->{$value->parent} = (object) array($value);

            } else {
                $arr_chld->{$value->parent} = (object) array_merge((array) $arr_chld->{$value->parent}, array($value));
            }
        }

        $decrypted_id = decrypt($encrypted_id);

        $user_role = UserRoles::where('id', $decrypted_id)->first();

        // active privileges stored in user privileges
        $user_privileges = DB::table('user_privileges')
                                ->where('role_id', $decrypted_id)
                                ->pluck('privilege_id')->toArray();

        return view('user_privileges.create', compact(['user_role', 'privileges', 'arr_chld', 'user_privileges']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_user_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'privileges' => 'required'
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $decrypted_role_id = decrypt($request->input('_role'));

        if(count($request->input('privileges')) !=0)
        {

            $deleted = UserPrivileges::where('role_id', $decrypted_role_id)->delete();

            foreach ($request->input('privileges') as $key => $value) {

                $privilege = UserPrivileges::firstOrNew([
                        'role_id' => $decrypted_role_id,
                        'privilege_id' => (int) $value
                    ]);

                $privilege->save();
            }
        }

        Session::flash('updated', 'User privileges is updated');

        return redirect()->back();
    }
}
