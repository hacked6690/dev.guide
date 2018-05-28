<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use \App\Helpers\Helper;
use Auth;
use Session;
use App\Languages;
use App\ContentTerms;
use App\ContentRelationships;
use App\GuidePrice;
use App\Model\Backend\GuidePriceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class GuidePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         if(!Auth::user()->authorized('posts')) {
            abort(403, 'Unauthorized action.');
        }

        $display = Input::has('display') ? Input::get('display') :7;

        $fees= ContentTerms::terms_by(['taxonomy' => 'fees']);
       $guideprices=GuidePrice::with('guideprice_detail')
            ->where('active','=','active')
            ->where('guide_id','=',Auth::user()->id)
            ->paginate($display);

        return view('backend.guideprice.index', compact(['guideprices', 'display','fees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
          $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
          $booleans= ContentTerms::terms_by(['taxonomy' => 'booleans']);
          return view('backend.guideprice.create',compact(['languages','provinces','booleans']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            $validator = Validator::make($request->all(), [
                'language_id' => 'required',
                'province_id' => 'required',
                'boolean_id' => 'required',
                'price' => 'required|numeric',
            ]);

      
        // dd($validator->errors());
        $guide_id=$request->has('guide_id')?$request->input('guide_id'):Auth::user()->id;
        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        } 

        $count=DB::table('guide_price')
            ->where('language_id',$request->language_id)
            ->where('province_id',$request->province_id)
            ->where('guide_id',$guide_id)
            ->count();
        if($count>0){
             Session::flash('warning', 'Duplicate setting...');
             return redirect()->back()
                    ->withInput($request->input());
        }

        $countDefault=DB::table('guide_price')
            ->where('default','yes')
            ->where('guide_id',$guide_id)
            ->count();
     
        if($countDefault>0 && ($request->input('boolean_id')=='yes')){
      
             Session::flash('warning', 'Default already exist');
             return redirect()->back()
                    ->withInput($request->input());
        }

        

        $gp = new GuidePrice([
                'guide_id' => $guide_id,
                'language_id' => $request->input('language_id'),
                'province_id' => $request->input('province_id'),
                'default' => $request->input('boolean_id'),
                'price' => $request->input('price'),
                'active' => 'active',
            ]);


        $gp->save();   
        Session::flash('inserted', 'Guide price has been set successfully...');
        if($request->has('sane'))
            return redirect('guideprice/create');
        return redirect('guideprice');
    }

    public function ajx_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'fee_id' => 'required',
        ]);     
        if($validator->fails()) {
          return response()->json([
                    'result' => false,
                    'msg' => 'Add request before submit',
                    'errors' => $validator->errors()
                ]);
        } 
        //Check Data to verify distinct value
        $count=DB::table('guideprice_detail')
            ->where('gp_id',$request->input('guideprice_id'))
            ->where('fee_id',$request->input('fee_id'))
            ->count();
        if($count>0){
             Session::flash('warning', 'Duplicate setting...');
              return response()->json([
                    'result' => false,
                    'msg' => 'Duplicate additional fee setting', 'warning', 'Duplicate setting...',
                ]);      
        }



        // $gpd==$guideprice_detail
            try{
            $gpd = new GuidePriceDetail([
                    'fee_id' => $request->input('fee_id'),
                    'gp_price' => $request->input('price'),
                    'gp_id' => $request->input('guideprice_id'),
                ]);
            $gpd->save();   
            return response()->json([
                    'result' => true,
                    'msg' => 'inserted', 'Guide price has been set successfully...',
                ]);       
            }catch(Exception $ex){    

            }
      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo $id=Helper::decodeString($id,Helper::encryptKey());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
