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
