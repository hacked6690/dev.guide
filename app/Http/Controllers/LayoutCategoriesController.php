<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\LayoutCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LayoutCategoriesController extends Controller
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
        if(!Auth::user()->authorized('layout_categories')) {
            abort(403, 'Unauthorized action.');
        }

        $layout_categories = LayoutCategories::orderBy('layout_categories.id', 'desc')->get();

        return view('layout_categories.index', compact('layout_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_layout_category')) {
            abort(403, 'Unauthorized action.');
        }

        return view('layout_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_layout_category')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:layout_categories',
                'title' => 'required|max:191',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $layout_category = new LayoutCategories([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
            ]);

        $layout_category->save();

        return redirect('layout_categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LayoutCategories  $layoutCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_layout_category')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $layout_category = LayoutCategories::where('id', $decrypted_id)->first();

        return view('layout_categories.edit', compact('layout_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LayoutCategories  $layoutCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_layout_category')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:layout_categories,slug,{$decrypted_id},id",
                'title' => 'required|max:191',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::table('layout_categories')
            ->where('id', $decrypted_id)
            ->update([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
            ]);

        Session::flash('updated', 'Layout category is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LayoutCategories  $layoutCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_layout_category')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $layout_category = DB::table('layout_categories')->where('id', $decrypted_id)->limit(1);
        $layout_category->delete();

        Session::flash('deleted', "Layout category is deleted");

        return redirect('layout_categories');
    }
}
