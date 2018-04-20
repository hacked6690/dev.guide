<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use File;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_profile')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $user_meta = \Helper::metas('user_meta', ['user_id' => $decrypted_id]);

        $profile = isset($user_meta->profile) ? Storage::url($decrypted_id .'/profile/'. $user_meta->profile->value) : '/assets/admin/img/avatars/male.png';

        $user = \App\User::select('id', 'role_id', 'email', 'created_at')->where('id', $decrypted_id)->first();

        return view('profiles.edit', compact(['user', 'user_meta', 'profile']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_profile')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'profile' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
                'name' => 'required',
                'phone' => 'nullable|regex:/^(?=.*[0-9])[- +()0-9]+$/',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

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

        Session::flash('updated', 'Profile is updated');

        return redirect()->route('profiles.edit', $encrypted_id);
    }
}
