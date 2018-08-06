<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LanguagesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->authorized('languages')) {
            abort(403, 'Unauthorized action.');
        }

        $languages = Languages::orderBy('languages.id', 'desc')->get();

        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_language')) {
            abort(403, 'Unauthorized action.');
        }

        return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_language')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:languages',
            'title' => 'required|max:191',
            'priority' => 'nullable|numeric',
            'set_default' => 'nullable|numeric',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $language = new Languages([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'priority' => ($request->has('priority') ? $request->input('priority') :0),
                'set_default' => ($request->has('set_default') ? $request->input('set_default') :0),
                'icon' => $request->input('icon'),
                'options' => $request->input('options'),
            ]);

        $language->save();

        return redirect('languages');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_language')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $language = Languages::where('id', $decrypted_id)->first();

        return view('languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_language')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
            'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:languages,slug,{$decrypted_id},id",
            'title' => 'required|max:191',
            'priority' => 'nullable|numeric',
            'set_default' => 'nullable|numeric',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('languages')
            ->where('id', $decrypted_id)
            ->update([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'priority' => $request->input('priority'),
                'set_default' => $request->input('set_default'),
                'icon' => $request->input('icon'),
            ]);

        Session::flash('updated', 'Language is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Languages  $languages
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_language')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $language = DB::table('languages')->where('id', $decrypted_id)->limit(1);
        $language->delete();

        Session::flash('deleted', "Language is deleted");

        return redirect('languages');
    }

    // set locale language ;
    public function set($encrypted_id)
    {
        $decrypted_id = decrypt($encrypted_id);

        $language = Languages::where('id', $decrypted_id)->first();

        if(!is_null($language))
        {
            Session::put('locale', $language->slug);
        }

        return redirect()->back();
    }
}
