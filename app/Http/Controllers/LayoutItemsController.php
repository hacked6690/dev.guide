<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\LayoutItems;
use App\LayoutCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class LayoutItemsController extends Controller
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
        if(!Auth::user()->authorized('layout_items')) {
            abort(403, 'Unauthorized action.');
        }

        /* init filter collection ; */
        $filter = collect([]);
        
        if(Input::has('filter')) 
        {
            $filter->put('layout_category', Input::get('filter'));
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $layout_items = DB::table('layout_items as li')
                            ->select(
                                'li.*', 
                                'lc.title as layout_category', 
                                DB::raw("(GROUP_CONCAT(languages.slug ORDER BY languages.slug ASC SEPARATOR ',')) as 'translated'")
                            )
                            ->leftJoin('layout_categories as lc', 'li.category_id', '=', 'lc.id')
                            ->leftJoin('layout_item_translates as lit', 'li.id', '=', 'lit.item_id')
                            ->leftJoin('languages', 'lit.language_id', '=', 'languages.id')
                            ->groupBy('li.id')
                            ->where(function($qry) use ($filter) {
                                if($filter->contains('layout_category')) {
                                    // $qry->where('li.category_id', '=', $filter->pull('layout_category'));
                                }
                            })
                            ->orderBy('li.id', 'desc')
                            ->paginate($display);

        return view('layout_items.index')
                    ->with(compact(['layout_items', 'display']))
                    ->with('filter', $filter->values());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_layout_item')) {
            abort(403, 'Unauthorized action.');
        }

        $layout_categories = LayoutCategories::all();

        $parents = LayoutItems::orderBy('layout_items.slug', 'asc')->get();
        $parents = DB::table('layout_items')
                  ->select('layout_items.*')
                  ->join('layout_categories', 'layout_items.category_id', '=', 'layout_categories.id')
                  ->where('layout_categories.slug','=','menu')
                  ->get();
        // dd($parents);

        return view('layout_items.create', compact(['layout_categories', 'parents']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_layout_item')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric',
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:layout_items',
                'title' => 'required',
                'parent' => 'nullable|numeric',
                'ordered' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $layout_item = new LayoutItems([
                'category_id' => $request->input('category_id'),
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'icon' => $request->input('icon'),
                'ordered' => $request->input('ordered'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
                'parent' => $request->input('parent'),
            ]);

        $layout_item->save();

        if($request->has('sane'))
            return redirect('layout_items/create');
        
        return redirect('layout_items');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LayoutItems  $layoutItems
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_layout_item')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $layout_categories = LayoutCategories::all();

        $layout_item = LayoutItems::where('id', $decrypted_id)->first();

        // $parents = LayoutItems::orderBy('layout_items.slug', 'asc')->get();
         $parents = DB::table('layout_items')
                  ->select('layout_items.*')
                  ->join('layout_categories', 'layout_items.category_id', '=', 'layout_categories.id')
                  ->where('layout_categories.slug','=','menu')
                  ->orderBy('layout_categories.slug','asc')
                  ->get();

        return view('layout_items.edit', compact(['layout_categories', 'layout_item', 'parents']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LayoutItems  $layoutItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_layout_item')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric',
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:layout_items,slug,{$decrypted_id},id",
                'title' => 'required',
                'parent' => 'nullable|numeric',
                'ordered' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        DB::table('layout_items')
            ->where('id', $decrypted_id)
            ->update([
                'category_id' => $request->input('category_id'),
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'icon' => $request->input('icon'),
                'ordered' => $request->input('ordered'),
                'description' => $request->input('description'),
                'options' => $request->input('options'),
                'parent' => $request->input('parent'),
            ]);

        Session::flash('updated', 'Layout item is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LayoutItems  $layoutItems
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_layout_item')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $layout_item = LayoutItems::where('id', $decrypted_id)->limit(1);
        $layout_item->delete();

        Session::flash('deleted', "Layout item is deleted");

        return redirect('layout_items');
    }
}
