<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\ContentTaxonomy;
use App\ContentTerms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

class ContentTermsController extends Controller
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
        if(!Auth::user()->authorized('content_terms')) {
            abort(403, 'Unauthorized action.');
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $content_terms = DB::table('content_terms')
                            ->select(
                                'content_terms.*',
                                'content_taxonomy.taxonomy',
                                'content_taxonomy.parent as parent'
                            )
                            ->join('content_taxonomy', function($join) {
                                $join->on('content_terms.term_id', '=', 'content_taxonomy.term_id');
                            })
                            ->orderBy('content_terms.term_id', 'desc')
                            ->paginate($display);
                        dd($content_terms);
        return view('content_terms.index', compact(['content_terms', 'display']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->authorized('create_content_term')) {
            abort(403, 'Unauthorized action.');
        }

        $taxonomies = DB::table('content_taxonomy')
                            ->distinct()
                            ->get(['taxonomy']);

        $terms = DB::table('content_terms')
                    ->select('content_terms.*')
                    ->get();

        return view('content_terms.create', compact(['taxonomies', 'terms']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_content_term')) {
            abort(403, 'Unauthorized action.');
        }

        $required_taxonomy = 'required';
        $required_new_taxonomy = 'nullable';

        if($request->has('new_taxonomy'))
        {
            $required_taxonomy = 'nullable';
            $required_new_taxonomy = 'required|max:191|regex:/^[0-9a-z_]+$/';
        }


        $validator = Validator::make($request->all(), [
                'taxonomy' => $required_taxonomy,
                'new_taxonomy' => $required_new_taxonomy,
                'slug' => 'required|regex:/^[0-9a-z_]+$/|max:100|unique:content_terms',
                'title' => 'required|max:512',
                'term_group' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }

        $term = new ContentTerms([
                        'slug' => $request->input('slug'),
                        'title' => $request->input('title'),
                        'term_group' => $request->input('term_group'),
                    ]);

        $term->save();

        // get existed taxonomy, Or use new one
        $_taxonomy = $request->has('new_taxonomy') ? $request->input('new_taxonomy') : $request->input('taxonomy');

        $taxonomy = new ContentTaxonomy([
                'term_id' => $term->id,
                'taxonomy' => strtolower($_taxonomy),
                'description' => $request->input('description'),
                'parent' => $request->input('parent'),
            ]);

        $taxonomy->save();

        // check if has meta -;
        if($request->has('term_meta'))
        {
            $qtm = array();
            foreach ($request->input('term_meta') as $key => $value) {
                $jd = json_decode($value);
                $qtm[key($jd)] = $jd->{key($jd)};
            }

            \Helper::store_meta('content_termmeta', ['term_id' => $term->id], $qtm, [], false);
        }

        Session::flash('inserted', 'New term is inserted');

        if($request->has('sane'))
            return redirect('content_terms/create');

        return redirect('content_terms');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentTerms  $contentTerms
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {
        if(!Auth::user()->authorized('update_content_term')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $taxonomies = DB::table('content_taxonomy')
                            ->distinct()
                            ->get(['taxonomy']);

        $terms = DB::table('content_terms')
                    ->select('content_terms.*')
                    ->get();

        // taxonomy of this term ;
        $tt = DB::table('content_taxonomy')
                        ->where('term_id', $decrypted_id)
                        ->first();

        $term = ContentTerms::where('term_id', $decrypted_id)->first();

        $meta = DB::table('content_termmeta')->where('term_id', $decrypted_id)->get()->toArray();

        $str_meta ='';

        if(count($meta) !=0)
        {
            foreach ($meta as $key => $value) {

                $merged = '{"'. $value->meta_key .'" : "'. $value->meta_value .'"}';

                $str_meta .="<section class='col col-6 flexibled-error ofmeta'>
                                    <label class='label'>
                                        &mdash;/. Term meta <code>*</code> <i class='glyphicon glyphicon-qrcode font-12'></i>
                                        <a href='javascript:;' class='btn btn-xs rollback-meta txt-color-red' data-cfm='true'>Clear</a>
                                        <div class='inline-block' id='for-term_meta[]'></div>
                                    </label>
                                    <label class='input'>
                                        <input type='text' name='term_meta[]' class='flexibled border-0 border-bottom-1 font-bold'
                                            value='". $merged ."' placeholder='{\"meta_key\" : \"meta_value\"}' />
                                    </label>
                                </section>";
            }
        }

        return view('content_terms.edit', compact(['taxonomies', 'terms', 'tt', 'term', 'meta', 'str_meta']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentTerms  $contentTerms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypted_id)
    {
        if(!Auth::user()->authorized('update_content_term')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $validator = Validator::make($request->all(), [
                'taxonomy' => 'required',
                'slug' => "required|regex:/^[0-9a-z_]+$/|max:100|unique:content_terms,slug,{$decrypted_id},term_id",
                'title' => 'required|max:512',
                'term_group' => 'nullable|numeric',
            ]);

        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }

        DB::table('content_terms')
            ->where('term_id', $decrypted_id)
            ->update([
                'slug' => $request->input('slug'),
                'title' => $request->input('title'),
                'term_group' => $request->input('term_group'),
            ]);

        DB::table('content_taxonomy')
            ->where('term_id', $decrypted_id)
            ->update([
                'taxonomy' => $request->input('taxonomy'),
                'description' => $request->input('description'),
                'parent' => $request->input('parent'),
            ]);

        // check if has meta ;

        $qtm = array();

        if($request->has('term_meta'))
        {
            foreach ($request->input('term_meta') as $key => $value)
            {
                if(!is_null($value))
                {
                    $jd = json_decode($value);

                    if($jd !=null)
                    {
                        $qtm[key($jd)] = $jd->{key($jd)};
                    }
                }
            }
        }

        \Helper::store_meta('content_termmeta', ['term_id' => $decrypted_id], $qtm, [], false);

        Session::flash('updated', 'Content term is updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentTerms  $contentTerms
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id)
    {
        if(!Auth::user()->authorized('delete_content_term')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $term = DB::table('content_terms')->where('term_id', $decrypted_id)->limit(1);
        $term->delete();

        $taxonomy = DB::table('content_taxonomy')->where('term_id', $decrypted_id)->limit(1);
        $taxonomy->delete();

        $meta = DB::table('content_termmeta')->where('term_id', $decrypted_id);
        $meta->delete();

        Session::flash('deleted', "Content term is deleted");

        return redirect('content_terms');
    }
}
