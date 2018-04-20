<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Languages;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
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
        if(!Auth::user()->authorized('pages')) {
            abort(403, 'Unauthorized action.');
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $pages = Pages::where('content_type', '=', 'page')
                    ->orderBy('created_at', 'desc')
                    ->paginate($display);

        return view('pages.index', compact(['pages', 'display']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_page')) {
            abort(403, 'Unauthorized action.');
        }

        $languages = Languages::orderBy('title', 'asc')->get();

        $ofpages = Pages::where('content_type', '=', 'page')
                        ->orderBy('title', 'asc')->get();

        return view('pages.create', compact(['languages', 'ofpages']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_page')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'translate_of' => 'nullable|numeric',
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:contents',
                'title' => 'required',
                'description' => 'required',
                'content_parent' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }

        // should keep in static type ;
        $content = new \stdClass();
        $content->type = 'page';
        $content->status = 'publish';

        $page = new Pages([
                'language_id' => $request->input('language_id'),
                'translate_of' => $request->input('translate_of'),
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'excerpt' => $request->input('excerpt'),
                'description' => $request->input('description'),
                'content_type' => $content->type,
                'content_status' => $content->status,
                'content_parent' => $request->input('content_parent'),
            ]);

        $page->save();

        Session::flash('inserted', 'New page is created');

        if($request->has('sane'))
            return redirect('pages/create');

        return redirect('pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show($encrypted_id)
    {
        if(!Auth::user()->authorized('read_page')) {
            abort(403, 'Unauthorized action.');
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_page')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $languages = Languages::orderBy('title', 'asc')->get();

        $ofpages = Pages::where('content_type', '=', 'page')
                        ->where('id', '<>', $decrypted_id)
                        ->orderBy('title', 'asc')->get();

        $page = Pages::where('id', $decrypted_id)->first();

        return view('pages.edit', compact(['languages', 'ofpages', 'page']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_page')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'translate_of' => 'nullable|numeric',
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:contents,slug,{$decrypted_id},id",
                'title' => 'required',
                'description' => 'required',
                'content_parent' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }

        // should keep in static type ;
        $content = new \stdClass();
        $content->type = 'page';
        $content->status = 'publish';

        DB::table('contents')
            ->where('id', $decrypted_id)
            ->update([
                'language_id' => $request->input('language_id'),
                'translate_of' => $request->input('translate_of'),
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'excerpt' => $request->input('excerpt'),
                'description' => $request->input('description'),
                'content_type' => $content->type,
                'content_status' => $content->status,
                'content_parent' => $request->input('content_parent'),
            ]);

        Session::flash('updated', 'Page is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_page')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $page = Pages::where('id', $decrypted_id)->limit(1);
        $page->delete();

        Session::flash('deleted', "Page is deleted");

        return redirect('pages');
    }
}
