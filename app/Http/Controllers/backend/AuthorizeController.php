<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\GuidePrice;
use App\UserRoles;
use Illuminate\Pagination\Paginator;
use App\ContentTerms;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Auth;
use App\Helpers\Helper;

class AuthorizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

         if(!Auth::user()->authorized('authorization_guide')) {
            abort(403, 'Unauthorized action.');
        }


        $display = Input::has('display') ? Input::get('display') :10;

        // $users = User::with('user_metas')->orderBy('id','desc')->get();
        $role_id = UserRoles::getRoleID('guide');
        $users = User::with('user_metas')->where('role_id','=',$role_id)->get();
        // dd($users);
        $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
       $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
       $partner_types= ContentTerms::terms_by(['taxonomy' => 'partner_types']);
       $guide_types= ContentTerms::terms_by(['taxonomy' => 'guide_types']);
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);  
       $guidestatus = [
            '0' => 'Pending',
            '1'  => 'active',
            '2'   => 'Suspense'
            
        ];
      
       
        //Getting from url form when searching
        $fullname_en=Input::has('fullname_en')?Input::get('fullname_en'):'';
        $guide_type_id=Input::has('guide_type_id')?intval(Input::get('guide_type_id')):0;
        $gender=Input::has('gender')?intval(Input::get('gender')):0;
        $nationality_id=Input::has('nationality_id')?intval(Input::get('nationality_id')):0;
        $guide_language=Input::has('guide_language')?intval(Input::get('guide_language')):0;
        $province_id=Input::has('province_id')?intval(Input::get('province_id')):0;
        $status_id=Input::has('status_id')?Input::get('status_id'):'all';

        $searchField=array(
                "fullname_en"=>$fullname_en,
                "guide_type_id"=>$guide_type_id,
                "gender"=>$gender,
                "nationality_id"=>$nationality_id,
                "guide_language"=>$guide_language,
                "province_id"=>$province_id,
                "status_id" => $status_id
                );
        $searchField=(object) $searchField;
        
    
         if ($fullname_en!=="") 
        {  
              $users = $users->filter(function($user) use ($fullname_en)
              {
                $u=$user->user_metas; 
                foreach ($u as $key => $value) {                    
                     if($value->meta_key =='fullname_en' && strpos(strtolower($value->meta_value), strtolower($fullname_en)) !== false) {                        
                        return $value;
                     }   
                }                 
               });
        }
        if ($guide_type_id!=0) 
        {  
              $users = $users->filter(function($user) use ($guide_type_id)
              {
                $u=$user->user_metas;                
                foreach ($u as $key => $value) {
                     if($value->meta_key =='guide_type_id' && $value->meta_value==$guide_type_id) {
                        return $value;
                     }   
                }                 
               });
        }
        if ($gender!=0) 
        {  
              $users = $users->filter(function($user) use ($gender)
              {
                $u=$user->user_metas;                
                foreach ($u as $key => $value) {
                     if($value->meta_key =='gender' && $value->meta_value==$gender) {
                        return $value;
                     }   
                }                 
               });
        }
        if ($nationality_id!=0) 
        {  
              $users = $users->filter(function($user) use ($nationality_id)
              {
                $u=$user->user_metas;                
                foreach ($u as $key => $value) {
                     if($value->meta_key =='nationality_id' && $value->meta_value==$nationality_id) {
                        return $value;
                     }   
                }                 
               });
        }
        if ($guide_language!=0) 
        {  
             $users = $users->filter(function($gp) use ($guide_language)
              {
                $u=$gp->guide_price;               
                foreach ($u as $key => $value) {
                     if($value->language_id==$guide_language){return $value;} 
                }                 
               });
        }
          if ($province_id!=0) 
        {  
              $users = $users->filter(function($gp) use ($province_id)
              {
                $u=$gp->guide_price;               
                foreach ($u as $key => $value) {
                     if($value->province_id==$province_id){return $value;} 
                }                 
               });
        }

         if ($status_id!='all') 
        {  
              
           $users = $users->filter(function($user) use ($status_id)
              {

                // $u=$user->active;                
                 if($user->active==$status_id) return $user;
               });
        }
   

      
        $page = Input::get('page', 1); // Get the ?page=1 from the url
        $perPage = $display; // Number of items per page
        $offset = ($page * $perPage) - $perPage;
        // dd(array_slice($users->toArray(), $offset, $perPage, true));
         $totalRecords=count($users);
        $users = new LengthAwarePaginator(
            array_slice($users->toArray(), $offset, $perPage, true), // Only grab the items we need
            count($users), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );




      


    
        return view('backend.authorize.index',compact(['display','users','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies','searchField','guidestatus','totalRecords']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }   

    public function mail_verify($user_id){
        $id=decrypt($user_id);
         User::where('id', $id)                
                 ->update(
                    ['active' => 1
                ]);

        return redirect('guides');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
        $id=decrypt($id);
        $display = Input::has('display') ? Input::get('display') :Helper::$DISPLAY;
        $privileges = DB::table('privileges as p1')
                        ->select('p1.*', 'p2.title as parent_title')
                        ->leftJoin('privileges as p2', 'p1.parent', '=', 'p2.id')
                        ->orderBy('p1.id', 'desc')
                        ->paginate($display);
       $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
       $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
       $partner_types= ContentTerms::terms_by(['taxonomy' => 'partner_types']);
       $guide_types= ContentTerms::terms_by(['taxonomy' => 'guide_types']);
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
       $guide = User::with('user_metas')->where('id','=',$id)->first();
       $guide_price = GuidePrice::where('guide_id','=',$id)->where('default','=','yes')->first();


       // Setting Price
         /*if(!Auth::user()->authorized('read_guideprice')) {
            abort(403, 'Unauthorized action.');
        }*/



       $fees= ContentTerms::terms_by(['taxonomy' => 'fees']);
       $guideprices=GuidePrice::with('guideprice_detail')
            ->where('active','=','active')
            ->where('guide_id','=',$id)
            ->paginate($display);

        // return view('backend.guideprice.index', compact(['guideprices','fees']));


       

        return view('backend.authorize.edit_guide',compact(['privileges', 'display','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies','guide','guide_price','guideprices','fees']));
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

     public function ajx_status(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);     
        if($validator->fails()) {
          return response()->json([
                    'result' => false,
                    'msg' => 'Add request before submit',
                    'errors' => $validator->errors()
                ]);
        } 

       

       
            $guide_id=decrypt($request->guide_id);
      
            try{
            User::where('id', $guide_id)
                 ->update(
                    ['active' => $request->status
                ]); 
            return response()->json([
                    'result' => true,
                    'msg' => 'inserted', 'Status updated successfully...',
                ]);       
            }catch(Exception $ex){    

            }
      
        
    }

    function settingprice($id)
    {
        $id=decrypt($id);
        $guide_id=$id;
       $fees= ContentTerms::terms_by(['taxonomy' => 'fees']);
       $guideprices=GuidePrice::with('guideprice_detail')
            ->where('active','=','active')
            ->where('guide_id','=',$id)
            ->paginate(10);
         $guideprices=GuidePrice::with('guideprice_detail')
            ->where('active','=','active')
            ->where('guide_id','=',$id)
            ->paginate(10);
        
  
      /*  if(!Auth::user()->authorized('create_guideprice')) {
            abort(403, 'Unauthorized action.');
            }*/

          $languages= GuidePrice::getLanguagesAPI();
          $provinces= GuidePrice::getProvincesAPI();
          $booleans= ContentTerms::terms_by(['taxonomy' => 'booleans']);


        return view('backend.authorize.settingprice',compact(['guideprices','fees','languages','provinces','booleans','guide_id']));
    }


}
