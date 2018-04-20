<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Languages;
use App\LayoutItems;
use App\LayoutItemTranslates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayoutItemTranslatesController extends Controller
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
        if(!Auth::user()->authorized('layout_item_translates')) {
            abort(403, 'Unauthorized action.');
        }

        $layout_item_translates = LayoutItemTranslates::all();

        return view('layout_item_translates.index', compact('layout_item_translates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($encrypted_id)
    {
        if(!Auth::user()->authorized('create_layout_item_translate')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($encrypted_id);

        $layout_item = LayoutItems::where('id', $decrypted_id)->limit(1)->first();

        $translated = LayoutItemTranslates::where('item_id', $decrypted_id)->pluck('language_id');

        $languages = Languages::where('slug', '!=', 'en')
                        ->whereNotIn('id', $translated)
                        ->get()->toArray();

        return view('layout_item_translates.create', compact(['layout_item', 'translated', 'languages']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->authorized('create_layout_item_translate')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                'item_id' => 'required|numeric',
                'language_id' => 'required|numeric',
                'title' => 'required',
            ]);

        $translated = LayoutItemTranslates::where('item_id', $request->input('item_id'))
                            ->where('language_id', $request->input('language_id'))
                            ->pluck('id');

        if(count($translated) !=0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('language_id', 'This language is already translated');
            });
        }

        if($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $layout_item_translate = new LayoutItemTranslates([
                'item_id' => $request->input('item_id'),
                'language_id' => $request->input('language_id'),
                'title' => $request->input('title'),
                'options' => $request->input('options'),
            ]);

        $layout_item_translate->save();

        return redirect('layout_items');
    }
}
