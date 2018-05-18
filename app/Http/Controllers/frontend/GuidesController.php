<?php
namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 300);
use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use Image;

use App\Languages;
use App\ContentRelationships;
use App\Posts;
use App\User;
use App\UserMetas;
use App\UserAccounts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\UserRoles;
use App\ContentTerms;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Model\Frontend\Guides;
class GuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
         
         $display = Input::has('display') ? Input::get('display') :7;

         

         $privileges = DB::table('privileges as p1')
                        ->select('p1.*', 'p2.title as parent_title')
                        ->leftJoin('privileges as p2', 'p1.parent', '=', 'p2.id')
                        ->orderBy('p1.id', 'desc')
                        ->paginate($display);
       $nationalities= ContentTerms::terms_by(['taxonomy' => 'nationalities']);
       $provinces= ContentTerms::terms_by(['taxonomy' => 'provinces']);
       $partner_types= ContentTerms::terms_by(['taxonomy' => 'partner_types']);
       $guide_types= ContentTerms::terms_by(['taxonomy' => 'guide_types']);
       $genders= ContentTerms::terms_by(['taxonomy' => 'gender']);
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);


        

      

        $fullname_en=Input::has('fullname_en')?Input::get('fullname_en'):'';
        $guide_type_id=Input::has('guide_type_id')?intval(Input::get('guide_type_id')):0;
        $gender=Input::has('gender')?intval(Input::get('gender')):0;
        $nationality_id=Input::has('nationality_id')?intval(Input::get('nationality_id')):0;
        $guide_language=Input::has('guide_language')?intval(Input::get('guide_language')):0;


       
         $search_criteria=array(
            "fullname_en"=>$fullname_en,
            "guide_type_id"=>$guide_type_id,
            "gender"=>$gender,
            "nationality_id"=>$nationality_id,
            "guide_language"=>$guide_language
            );

      /*  $users = User::with('user_metas')->groupBy('id')->get();        
        $users = $users->filter(function($value, $key) use ($search_criteria) {     
        foreach ($search_criteria as $k => $v) {
            foreach ($value->user_metas as $subkey => $subvalue) {
                if($subvalue->meta_key =='fullname_en' && strpos($subvalue->meta_value, 'Prof') !== false) {
                        return $value;
                }                  
            }            
        }
        echo json_encode($value);
        echo "<hr>";                
        });*/

       $criteria=array(
            "fullname_en"=>$fullname_en,
            "guide_type_id"=>$guide_type_id,
            "gender"=>$gender,
            "nationality_id"=>$nationality_id,
            "guide_language"=>$guide_language
        );
       $check=0;
       foreach ($criteria as $key => $value) {
           if(isset($key) && ($value!=0 || $value!="")){
            $check++;
           }
       }
      

           $users = User::with('user_metas')->groupBy('id')->get(); 
        
       
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
              $users = $users->filter(function($user) use ($guide_language)
              {
                $u=$user->user_metas;                
                foreach ($u as $key => $value) {
                     if($value->meta_key =='language_id' && $value->meta_value==$guide_language) {
                        return $value;
                     }   
                }                 
               });
        }
      

    $display=10;
    $page = Input::has('page')?intval(Input::get('page')):1;
    $perPage = $display;
    $offset = ($page * $perPage) - $perPage;
    $until=$offset+$perPage;
    echo $totalRecord=sizeof($users);echo "Records <br>";
    echo $totalPage=ceil($totalRecord/$perPage); echo "Page<br>";
  

    $new_users=[];
    foreach ($users as $user) {

        $new_users[]=$user;
    }
    $new_users = array_slice($new_users, $offset, $perPage);
    $users=$new_users;







     

        return view('frontend.guides.listing', compact(['users','privileges', 'display','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies']));
    }
    public static function get_user_meta($user_id=1)
    {
         return $users=User::find($user_id)->user_metas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function getRoleID($slug=''){
          $id = DB::table('user_roles')->select('id')->where('slug', $slug)->first();
          return $id;
    }
    public function create()
    {
        //
      /* if(!Auth::user()->authorized('posts')) {
            abort(403, 'Unauthorized action.');
        }*/
         $display = Input::has('display') ? Input::get('display') :7;

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
      

     

        return view('frontend.guides.index', compact(['privileges', 'display','nationalities','provinces','partner_types','genders',
            'guide_types','guide_languages','proficiencies']));

    }
    public function detail($uid)
    {
       //
        $uid=Helper::decodeString($uid,Helper::encryptKey());
        $display = Input::has('display') ? Input::get('display') :7;
        $privileges = DB::table('privileges as p1')
                        ->select('p1.*', 'p2.title as parent_title')
                        ->leftJoin('privileges as p2', 'p1.parent', '=', 'p2.id')
                        ->orderBy('p1.id', 'desc')
                        ->paginate($display);

        $user_meta=Helper::metas('user_meta',['user_id' => $uid] );
        $user=DB::table('users')->find($uid);
        return view('frontend.guides.detail', compact(['user_meta','user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store2(Request $request)
    {
            // return redirect('login');
    }
    public function store(Request $request)
    {
        //
         // dd(Helper::MyFormatDate($request->date_of_birth));

         $validator = Validator::make($request->all(), [
                 
                
                'license_id' => 'required',
                'fullname_kh' => 'required',
                'fullname_en' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'telephone' => 'required|numeric',
                'nationality_id' => 'required',
                'province_id' => 'required',
                'language_id' => 'required',
                'guide_price' => 'required|numeric',
                'password' => 'required|min:6|confirmed',
                'generation' => 'required|numeric',
                'guide_certified' => 'required',
                'behavior_certified' => 'required',
                'guide_type_id' => 'required',
                'id_card' => 'required',
                'partner_id' => 'required',
                'cv_provided' => 'required',
                'domicile_certified' => 'required',
                'new_renew' => 'required',
                'issued_date' => 'required',
                'expired_date' => 'required',
                'date_in_service' => 'required',
                'agree' => 'required',
                'photo' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
            ]);
        // dd($validator->errors());
    
        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }             
        // decrypted role_id, cause encrypted at frontend
        $user = new User([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

        $user->save(); 

         $request->merge(['password' => Hash::make($request->input('password'))]);
         $request->merge(['dob' => Helper::MyFormatDate($request->input('dob'))]);
         $request->merge(['date_in_service' => Helper::MyFormatDate($request->input('date_in_service'))]);
         $request->merge(['issued_date' => Helper::MyFormatDate($request->input('issued_date'))]);
         $request->merge(['expired_date' => Helper::MyFormatDate($request->input('expired_date'))]);

        //Old Table Field on Guide table----Store User meta
               /* $old_fields=array('rate_one','rate_two','rate_three','rate_four','rate_five',
                    'is_recommended','certificate_number','global_rate','number_group_visitors','number_visitors');
                for($i=0;$i<sizeof($old_fields);$i++){
                    $user_meta = new UserMetas([
                            'user_id' => $user->id,
                            'meta_key' => $old_fields[$i],
                            'meta_value' => ''
                        ]);
                    $user_meta->save();
                }*/
        //end Old Table Fields

         // store user meta if inputed ____
        $default = array('license_id','fullname_en', 'fullname_kh','address',
            'dob', 'gender','telephone',
            'nationality_id', 
             'province_id',
            'language_id',
            'guide_price',
            'password',
            'generation', 'guide_certified','behavior_certified',
            'id_card', 'partner_id','cv_provided',
            'first_name', 'last_name','first_name_kh','guide_type_id',
            'domicile_certified','new_renew','issued_date','expired_date',
            'date_in_service','photo'

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

        Session::flash('inserted', 'Guide profile is saved successfully...');


        return redirect('guides');


        
      



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
