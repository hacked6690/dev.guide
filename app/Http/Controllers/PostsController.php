<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Languages;
use App\ContentRelationships;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class PostsController extends Controller
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
        if(!Auth::user()->authorized('posts')) {
            abort(403, 'Unauthorized action.');
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $posts = Posts::where('content_type', 'post')
                    ->orderBy('created_at', 'desc')
                    ->paginate($display);

        return view('posts.index', compact(['posts', 'display']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_post')) {
            abort(403, 'Unauthorized action.');
        }

        $languages = Languages::orderBy('title', 'asc')->get();

        $ofposts = Posts::where('content_type', '=', 'post')
                        ->orderBy('title', 'asc')->get();

        $categories = DB::table('content_terms')
                            ->select(
                                'content_terms.*',
                                'content_taxonomy.taxonomy',
                                'content_taxonomy.parent as parent'
                            )
                            ->join('content_taxonomy', function($join) {
                                $join->on('content_terms.term_id', '=', 'content_taxonomy.term_id');
                                $join->where('content_taxonomy.taxonomy', '=', 'category');
                            })
                            ->orderBy('content_terms.title', 'asc')
                            ->get();

        return view('posts.create', compact(['languages', 'ofposts', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_post')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'translate_of' => 'nullable|numeric',
                'categories' => 'required',
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
        $content->type = 'post';
        $content->status = 'publish';

        $post = new Posts([
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

        $post->save();

        // store contents relationships ;
        $data = [];

        foreach ($request->input('categories') as $category)
        {
            $data[] = array('object_id' => $post->id, 'taxonomy_id' => $category);
        }

        if(count($data) !==0)
        {
            ContentRelationships::insert($data);
        }

        Session::flash('inserted', 'New post is created');

        if($request->has('sane'))
            return redirect('posts/create');

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($encrypted_id)
    {
        if(!Auth::user()->authorized('read_post')) {
            abort(403, 'Unauthorized action.');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_post')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $languages = Languages::orderBy('title', 'asc')->get();

        $ofposts = Posts::where('content_type', '=', 'post')
                        ->where('id', '<>', $decrypted_id)
                        ->orderBy('title', 'asc')->get();

        $categories = DB::table('content_terms')
                            ->select(
                                'content_terms.*',
                                'content_taxonomy.taxonomy',
                                'content_taxonomy.parent as parent'
                            )
                            ->join('content_taxonomy', function($join) {
                                $join->on('content_terms.term_id', '=', 'content_taxonomy.term_id');
                                $join->where('content_taxonomy.taxonomy', '=', 'category');
                            })
                            ->orderBy('content_terms.title', 'asc')
                            ->get();

        $post_categories = ContentRelationships::where('object_id', $decrypted_id)->pluck('taxonomy_id');

        $post = Posts::where('id', $decrypted_id)->first();

        return view('posts.edit', compact(['languages', 'ofposts', 'categories', 'post_categories', 'post']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_post')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'language_id' => 'required|numeric',
                'translate_of' => 'nullable|numeric',
                'categories' => 'required',
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
        $content->type = 'post';
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

        $post_categories = ContentRelationships::where('object_id', $decrypted_id)->pluck('taxonomy_id')->toArray();

        $data = [];

        foreach ($request->input('categories') as $category)
        {
            if(in_array($category, $post_categories))
            {
                $post_categories = array_diff($post_categories, [$category]);
            } else {
                $data[] = array('object_id' => $decrypted_id, 'taxonomy_id' => $category);
            }
        }

        // remove existed post categories, after filtered ;
        if(count($post_categories) !==0)
        {
            DB::table('content_relationships')
                ->where('object_id', '=', $decrypted_id)
                ->whereIn('taxonomy_id', $post_categories)
                ->delete();
        }

        // store new content relationships ;
        if(count($data) !==0)
        {
            ContentRelationships::insert($data);
        }

        Session::flash('updated', 'Post is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_post')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $post = Posts::where('id', $decrypted_id)->limit(1);
        $post->delete();

        // Also remove from content relationships ;
        $post_categories = ContentRelationships::where('object_id', $decrypted_id);
        $post_categories->delete();

        Session::flash('deleted', "Post is deleted");

        return redirect('posts');
    }
}
