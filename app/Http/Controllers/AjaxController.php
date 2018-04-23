<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use Carbon\Carbon;
use Image;
use File;

use App\Ajax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // these are fixed method ;
    public function of_taxonomy(Request $request)
    {
        $result = false;

        $validator = Validator::make($request->all(), [
                'taxonomy' => 'required',
                'parent_id' => 'required|numeric',
            ]);

        if($validator->fails()) {
            return response()->json(['result' => false, 'errors' => $validator]);
        }

        $taxonomy = \App\ContentTaxonomy::where('taxonomy', '=', $request->input('taxonomy'))
                                ->where('term_id', '=', $request->input('parent_id'))
                                ->get();

        $str_option = \Helper::empty_option();

        if(!is_null($taxonomy))
        {
            $result = true;

            $str_option .= \App\ContentTerms::opt_by(['parent' => $request->input('parent_id')]);
        }

        return response()->json([
                'result' => $result,
                'option' => $str_option
            ]);
    }

    public function realtime_upload(Request $request)
    {
        // assign empty array ;
        $msg = \Helper::layout()->label->realtime->title;
        $success = $errors = [];

        foreach($request->file('files') as $file)
        {
            $extension = $file->getClientOriginalExtension();
            $rule = 'mimes:jpg,jpeg,png,bmp,gif,svg';

            if(in_array($extension, explode(',', 'video/avi,video/mpeg,video/quicktime')))
            {
                $rule = 'mimetypes:video/avi,video/mpeg,video/quicktime';
            }
            else if(in_array($extension, explode(',', 'doc,docx,csv,xlsx,xls,ppt,odt,ods,odp,pdf')))
            {
                $rule = 'mimes:doc,docx,csv,xlsx,xls,ppt,odt,ods,odp,pdf';
            }
            else if(in_array($extension, explode(',', 'zip')))
            {
                $rule = 'mimes:zip';
            }

            $validator = Validator::make($request->all(), [
                    'files' => 'required|array',
                    'files.*' => "{$rule}|max:" . (1024 *32),
                ]);

            if($validator->fails())
            {
                $errors[] = $validator->errors();
            } else {

                if(Auth::check())
                {
                    $file->store(Auth::user()->id, 'public');

                    // if it 's images, then resize ;
                    if(in_array($extension, explode(',', 'jpg,jpeg,png,bmp,gif,svg')))
                    {
                        $directory = storage_path('app/public/'. Auth::user()->id);

                        $thumbnails = array('100x100');

                        if($request->has('render'))
                        {
                            if($request->input('render') ==='custom') {

                                if($request->has('rndsize'))
                                {
                                    $thumbnails = array($request->input('rndsize'));
                                }
                            }
                        }

                        foreach ($thumbnails as $thumbnail)
                        {
                            $tmp = $directory .'/'. $thumbnail;

                            if(!File::exists($tmp))
                            {
                                File::makeDirectory($tmp);
                            }
                        }

                        // End - create directory ;

                        $i100 = Image::make($file->getRealPath())->fit(100);
                        $i100->save($directory . '/100x100/'. $file->hashName());

                        if($request->has('render'))
                        {
                            if($request->input('render') ==='custom') {

                                if($request->has('rndsize') && strpos($request->input('rndsize'), 'x') !==false)
                                {
                                    $size = array_map('trim', explode('x', $request->input('rndsize')));

                                    if(count($size) ==2 && is_numeric($size[0]) && is_numeric($size[1]))
                                    {
                                        $i_custom = Image::make($file->getRealPath())->fit($size[0], $size[1]);
                                        $i_custom->save($directory . '/'. $request->input('rndsize') .'/'. $file->hashName());
                                    }
                                }
                            }
                        }
                    }

                } else {
                    $file->store('', 'public');
                }

                $now = Carbon::now('utc')->toDateTimeString();

                $id = DB::table('files')
                            ->insertGetId([
                                'name' => ($file->isValid() ? $file->getClientOriginalName() :null),
                                'url' => ($file->isValid() ? $file->hashName() :null),
                                'type' => ($file->isValid() ? $file->getClientMimeType() :null),
                                'ip' => (\Helper::client_ip() !==null ? \Helper::client_ip() :$request->ip()),
                                'created_by' => (Auth::check() ? Auth::user()->id :0),
                                'created_at' => $now,
                                'updated_at' => $now,
                            ]);

                $success[] = $file->hashName();
            }
        }

        return response()->json([
            'result' => true,
            'success' => $success,
            'errors' => $errors,
            'msg' => $msg,
        ]);
    }
}
