<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserRolesController extends Controller
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
        if(!Auth::user()->authorized('user_roles')) {
            abort(403, 'Unauthorized action.');
        }

        $user_roles = UserRoles::orderBy('user_roles.id', 'desc')->get();

        return view('user_roles.index', compact('user_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_user_role')) {
            abort(403, 'Unauthorized action.');
        }

        return view('user_roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_user_role')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:user_roles',
                'title' => 'required|max:191',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $user_role = new UserRoles([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
            ]);

        $user_role->save();

        return redirect('user_roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRoles  $userRoles
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {        
        if(!Auth::user()->authorized('update_user_role')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $user_role = UserRoles::where('id', $decrypted_id)->first();

        return view('user_roles.edit', compact('user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRoles  $userRoles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_user_role')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:user_roles,slug,{$decrypted_id},id",
                'title' => 'required|max:191',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::table('user_roles')
            ->where('id', $decrypted_id)
            ->update([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
            ]);

        Session::flash('updated', 'User role is updated');

        return redirect()->route('user_roles.edit', $encrypted_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRoles  $userRoles
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {        
        if(!Auth::user()->authorized('delete_user_role')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $user_role = DB::table('user_roles')->where('id', $decrypted_id)->limit(1);
        $user_role->delete();

        Session::flash('deleted', "User role is deleted");

        return redirect('user_roles');
    }
}
