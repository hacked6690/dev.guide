<?php

namespace App\Http\Controllers\frontend;


use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use Image;
use App\Languages;
use App\ContentRelationships;
use App\Posts;
use App\User;
use App\GuidePrice;
use App\Model\Backend\Bookings;
use App\UserMetas;
use App\UserAccounts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\UserRoles;
use App\ContentTerms;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Model\Frontend\Guides;
class TravellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(Auth::check()){
               /* if(!Auth::user()->authorized('traveller_online')) {
                abort(403, 'Unauthorized action.');
                }*/
         }


        $display = Input::has('display') ? Input::get('display') :10;

      
        $role_id = UserRoles::getRoleID('traveller');
        $users = User::with('user_metas')->where('role_id','=',$role_id)->get();
        // dd($users);
        $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
      
      
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
    
      
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




      
          $us=User::getUserLogin();

        if(Auth::check()){
            if($us=='mot' || $us=='admin')
            return view('backend.travellers.index',compact(['display','users','nationalities','genders'
             ,'searchField','guidestatus','totalRecords']));
        }
             return view('frontend.travellers.index',compact(['display','users','nationalities','genders'
                    ,'searchField','guidestatus','totalRecords']));
 
        

      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
           $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
       $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
       $partner_types= ContentTerms::terms_by(['taxonomy' => 'partner_types']);
       $guide_types= ContentTerms::terms_by(['taxonomy' => 'guide_types']);
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
       return view('frontend.travellers.create', compact([ 'display','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies']));
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
                 
                'fullname_kh' => 'required',
                'fullname_en' => 'required',
                'email' => 'required|email',
                // 'address' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'telephone' => 'required|numeric',
                'nationality_id' => 'required',                
                'password' => 'required|min:6|confirmed',                
                // 'photo' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
            ]);         
        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }   
        $role_id=UserRoles::getRoleID('traveller');   

    
        $user = new User([
                'role_id' => $role_id,
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'active' => 1,
                'remember_token' =>$request->input('_token'),
            ]);
        $user->save(); 

         $request->merge(['password' => Hash::make($request->input('password'))]);
         $request->merge(['dob' => Helper::MyFormatDate($request->input('dob'))]);
        

     

         // store user meta if inputed ____
        $default = array('fullname_en', 'fullname_kh','address',
            'dob', 'gender','telephone',
            'nationality_id', 
             'photo',
            );

        foreach ($request->all() as $key => $value)
        {
            if(in_array($key, $default))
            {
                $valued = $value;

                if($key =='photo')
                {
                    // store profile ;
                    $request->photo->store($user->id, 'public');

                    $profile_dir = storage_path('app/public/'. $user->id .'/profile');

                    if(!File::exists($profile_dir))
                    {
                        File::makeDirectory($profile_dir);
                    }

                    Image::make($request->photo->getRealPath())->fit(120)->save($profile_dir .'/'. $request->photo->hashName());

                    $valued = $request->photo->hashName();
                }

                $user_meta = new UserMetas([
                        'user_id' => $user->id,
                        'meta_key' => $key,
                        'meta_value' => $valued
                    ]);

                $user_meta->save();
            }           
            
        }       

        Session::flash('inserted', 'Traveller profile is saved successfully...');
        return back();


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
         $user=User::find($id);
         $user_meta = \Helper::metas('user_meta', ['user_id' => $id]);
        //
       $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
       $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
       $partner_types= ContentTerms::terms_by(['taxonomy' => 'partner_types']);
       $guide_types= ContentTerms::terms_by(['taxonomy' => 'guide_types']);
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
       return view('backend.travellers.edit', compact([ 'display','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies','user','user_meta']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function ajx_status(Request $request)
    {

        //Guide ID here is mean that traveller id
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

       

       
            $traveller_id=decrypt($request->traveller_id);
      
            try{
            User::where('id', $traveller_id)
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

    public function update(Request $request, $id)
    {
        //
         if(!Auth::user()->authorized('traveler_edit')) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
                 
                'fullname_kh' => 'required',
                'fullname_en' => 'required',
               
                // 'address' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'telephone' => 'required|numeric',
                'nationality_id' => 'required',                
                            
                // 'photo' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
            ]);         
        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }   
        $role_id=UserRoles::getRoleID('traveller');   
        $id=decrypt($id);

         // store user meta if inputed ____
        $default = array('fullname_en', 'fullname_kh','address',
            'dob', 'gender','telephone',
            'nationality_id', 
             'photo',
            );

        foreach ($request->all() as $key => $value)
        {
            if(in_array($key, $default))
            {
                $valued = $value;

                if($key =='photo')
                {
                    // store profile ;
                    $request->photo->store($id, 'public');

                    $profile_dir = storage_path('app/public/'. $id .'/profile');

                    if(!File::exists($profile_dir))
                    {
                        File::makeDirectory($profile_dir);
                    }

                    Image::make($request->photo->getRealPath())->fit(120)->save($profile_dir .'/'. $request->photo->hashName());

                    $valued = $request->photo->hashName();
                }

              

                  UserMetas::where('user_id', $id)->where('meta_key','=',$key)->update(
                [       'user_id' => $id,
                        'meta_key' => $key,
                        'meta_value' => $valued
                ]);


            }           
            
        }   
         Session::flash('updated', 'Traveller profile is updated successfully...');
        return back();    

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
         if(!Auth::user()->authorized('traveller_delete')) {
            abort(403, 'Unauthorized action.');
        }

        $decrypted_id = decrypt($id);
        $u = User::where('id', $decrypted_id)->limit(1);
        $u->delete();      

        Session::flash('deleted', "Traveller Profile was deleted");

        return back();
    }
}
