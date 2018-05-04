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
       return $this->create();
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
       $guide_languages= ContentTerms::terms_by(['taxonomy' => 'guide_languages']);
       $proficiencies= ContentTerms::terms_by(['taxonomy' => 'proficiencies']);
      

     

        return view('guides.index', compact(['privileges', 'display','nationalities','provinces','partner_types',
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
            return redirect('login');
    }
    public function store2(Request $request)
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
                'province' => 'required',
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
                'profile' => 'image|mimes:jpg,jpeg,png,bmp|max:' . (1024 *16),
            ]);
        // dd($validator->errors());
    
        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        }             
        // decrypted role_id, cause encrypted at frontend
        $user = new User([
                'role_id' => getRoleID('guide'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

        $user->save(); 

         $request->merge(['password' => Hash::make($request->input('password'))]);

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
            'nationality', 'province','password',
            'generation', 'guide_certified','behavior_certified',
            'id_card', 'partner_id','cv_provided',
            'first_name', 'last_name','first_name_kh','guide_type_id',
            'domicile_certified','new_renew','issued_date','expired_date',
            'date_in_service','profile'

            );

        foreach ($request->all() as $key => $value)
        {
            if(in_array($key, $default))
            {
                $valued = $value;

                if($key =='profile')
                {
                    // store profile ;
                    $request->profile->store($user->id, 'public');

                    $profile_dir = storage_path('app/public/'. $user->id .'/profile');

                    if(!File::exists($profile_dir))
                    {
                        File::makeDirectory($profile_dir);
                    }

                    Image::make($request->profile->getRealPath())->fit(120)->save($profile_dir .'/'. $request->profile->hashName());

                    $valued = $request->profile->hashName();
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

        return redirect('login');


        
      



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