<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Privileges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class PrivilegesController extends Controller
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
        if(!Auth::user()->authorized('privileges')) {
            abort(403, 'Unauthorized action.');
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $privileges = DB::table('privileges as p1')
                        ->select('p1.*', 'p2.title as parent_title')
                        ->leftJoin('privileges as p2', 'p1.parent', '=', 'p2.id')
                        ->orderBy('p1.id', 'desc')
                        ->paginate($display);

        return view('privileges.index', compact(['privileges', 'display']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $privileges = Privileges::orderBy('title', 'asc')->get();

        return view('privileges.create', compact('privileges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:privileges',
                'title' => 'required|max:191',
                'parent' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $privilege = new Privileges([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'parent' => $request->input('parent'),
                'description' => $request->input('description'),
            ]);

        $privilege->save();

        if($request->has('sane'))
            return redirect('privileges/create');
        
        return redirect('privileges');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Privileges  $privileges
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $privilege = Privileges::where('id', $decrypted_id)->first();

        $privileges = Privileges::orderBy('title', 'asc')->get();

        return view('privileges.edit', compact(['privileges', 'privilege']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Privileges  $privileges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:privileges,slug,{$decrypted_id},id",
                'title' => 'required|max:191',
                'parent' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        Privileges::where('id', $decrypted_id)
            ->update([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'parent' => $request->input('parent'),
                'description' => $request->input('description'),
            ]);

        Session::flash('updated', 'Privilege is updated');

        return redirect()->route('privileges.edit', $encrypted_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Privileges  $privileges
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_privilege')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $privilege = Privileges::where('id', $decrypted_id)->limit(1);
        $privilege->delete();

        Session::flash('deleted', "Privilege is deleted");

        return redirect('privileges');
    }
}
