<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return view('frontend.home.index');
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
    public function pagenotfound()
    {
       return view('errors.pagenotfound');
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
    public function sys_register(){
        return view('frontend.sys_register');
    }
     public function contact_us(){    
        return view('frontend.contact_us');
    }

     public function save_contact_us(Request $request){
         $now = Carbon::now();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'telephone' => 'required|numeric',
        ]);   

        if($validator->fails()) {
            return redirect()->back()
                        ->withInput()
                        ->withErrors($validator);
        } 

        $name = Input::has('name')?Input::get('name'):'';
        $email = Input::has('email')?Input::get('email'):'';
        $telephone = Input::has('telephone')?Input::get('telephone'):'';
        $message = Input::has('message')?Input::get('message'):'';
        DB::table('contactus')->insert(
            [
                'fullname_en' => $name,
                'email' => $email,
                'telephone' => $telephone,
                'message' => $message,
                'created_at' => $now,
                'active' => 1
            ]
        );        
        Session::flash('inserted', 'Submited...');
      


        return back();
    }

}
