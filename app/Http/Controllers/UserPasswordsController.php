<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\User;
use App\UserPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserPasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPasswords  $userPasswords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_password')) {
            abort(403, 'Unauthorized action.');
        }

        // flash session for #tab active
        Session::flash('password', 'active');

        $decrypted_id = decrypt($encrypted_id);

        $user = User::find($decrypted_id);

        $validator = Validator::make($request->all(), [
                'curr_password' => 'required|min:6',
                'password' => 'required|min:6|confirmed'
            ]);

        if(!Hash::check($request->input('curr_password'), $user->password)) {
            $validator->after(function ($validator) {
                $validator->errors()->add('curr_password', 'Current pwd not matched');
            });
        }

        if($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        Session::flash('updated_pwd', 'Password is updated');

        return redirect()->back();
    }
}
