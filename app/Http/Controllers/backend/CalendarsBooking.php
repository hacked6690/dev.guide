<?php

namespace App\Http\Controllers\backend;
use Auth;
use App\Helpers\Helper;
use Session;
use App\User;
use App\UserRoles;
use App\ContentTerms;
use App\Model\Backend\Bookings;
use App\UserMetas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
class CalendarsBooking extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function events(){
          return Bookings::events(Auth::user()->id);
    }
       public function event_history($booking_status="event"){
        $now = Carbon::now();
        $guide_id=Auth::user()->id;

        //$month=$now->month;
         $display = Input::has('display') ? Input::get('display') :5;
         $search = Input::has('search') ? Input::get('search') :'';
         $month = Input::has('month') ? Input::get('month') :'';
         $year = Input::has('year') ? Input::get('year') :'';

         $listings=Bookings::where('guide_id',$guide_id)
                     ->where('active','=','active')
                     ->where('booking_status','=',Bookings::statusID($booking_status))
                     ->when($search!="", function($query) use ($search) {
                             $query->where('title', '=', $search); 
                        })
                     ->when($month!="", function($query) use ($month) {
                             $query->whereMonth('start', '=', $month); 
                        })
                     ->when($year!="", function($query) use ($year) {
                             $query->whereYear('start', '=', $year); 
                        })
                    ->orderBy('start','asc')
                    ->paginate($display);

         $filter = (object)array(
                        "month"=>$month,
                        "year"=>$year,
                        "search" => $search
                    );
        return view('backend.calendarsbooking.event_history',compact(['listings','booking_status','display','filter']));
    }


    public function booking_history($booking_status="booking"){
        $now = Carbon::now();
        $guide_id=Auth::user()->id;
        //$month=$now->month;
         $display = Input::has('display') ? Input::get('display') :5;
         $search = Input::has('search') ? Input::get('search') :'';
         $month = Input::has('month') ? Input::get('month') :'';
         $year = Input::has('year') ? Input::get('year') :'';

         $listings=Bookings::where('guide_id',$guide_id)
                     ->where('active','=','active')
                     ->where('booking_status','=',Bookings::statusID($booking_status))
                     ->when($search!="", function($query) use ($search) {
                             $query->where('title', '=', $search); 
                        })
                     ->when($month!="", function($query) use ($month) {
                             $query->whereMonth('start', '=', $month); 
                        })
                     ->when($year!="", function($query) use ($year) {
                             $query->whereYear('start', '=', $year); 
                        })
                    ->orderBy('start','desc')
                    ->paginate($display);
         $filter = (object)array(
                        "month"=>$month,
                        "year"=>$year,
                        "search" => $search
                    );
        return view('backend.calendarsbooking.history',compact(['listings','booking_status','display','filter']));
    }
    public function index()
    {
        $booking_status= ContentTerms::terms_by(['taxonomy' => 'booking_status']);
        $list_bookings=Bookings::list_bookings(Auth::user()->id);
        $booking_custom=[];
        foreach ($list_bookings as $lb) {          
                $enddate = date_create($lb->end); // For today/now, don't pass an arg.
                // $enddate->modify("-1 day");
               $enddate=$enddate->format("Y-m-d");
            if($lb->booking_status==$booking_status[0]->term_id){
                $bg="red";
            }else{
                $bg="gray";
            }
            $booking_custom[]=array(
                        'id'=>encrypt($lb->id),
                        'title'=>$lb->title,
                        'active'=>$lb->active,
                        'description'=>$lb->description,
                        'icon'=>$lb->icon,
                        'backgroundColor' => $bg,
                        'booking_status' => $lb->booking_status,
                        'start'=>$lb->start,
                        'end'=>$enddate
                        );
        }
        $list_bookings=$booking_custom;
        return view('backend.calendarsbooking.index',compact(['list_bookings','booking_status']));
    }

    public static function detail($id){
      $id=decrypt($id);
      $booking=Bookings::find($id);
      $guide_id=($booking->guide_id);
      $user=User::find($guide_id);
      $guide_meta=Helper::metas('user_meta',['user_id' => $guide_id] );
      $inputer_meta=Helper::metas('user_meta',['user_id' => $booking->creator_id] );
      // dd($user);
      // dd($guide_meta);
      // dd($inputer_meta);
      return view('backend.calendarsbooking.detail',compact(['user','booking','guide_meta','inputer_meta']));
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
    public function ajx_delete(Request $request)
    {
        $decrypted_id=$request->input('cmd_id');
        $decrypted_id = decrypt($decrypted_id);
        $gpDetail = Bookings::where('id', $decrypted_id)->limit(1);
        $gpDetail->delete();
        // Session::flash('deleted', "Booking is deleted");
         return response()->json([
                        'result' => true,
                        'msg' => 'deleted', 'Deleted successfully...',
                         'callback' => 'abc',
                    ]);  
    }
      public function ajx_store(Request $request)
    {
         $guide_id=Auth::user()->id;
         $creator_id=Auth::user()->id;
         
        
        if($request->input('cmd_submit')=="Save"){
            try{
                $validator = Validator::make($request->all(), [
                    'booking_status' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                ]);  
                if($validator->fails()) {
                  return response()->json([
                            'result' => false,
                            'msg' => 'Please check your field before submiting',
                            'errors' => $validator->errors()
                        ]);
                }   

                $enddate = date_create($request->input('ending')); // For today/now, don't pass an arg.
                $enddate->modify("+1 day");
                $enddate=$enddate->format("Y-m-d");
                $booking = new Bookings([
                        'guide_id' => $guide_id,
                        'creator_id' => $creator_id,
                        // 'lang_id' => ,
                        'active' => 'active',
                        'title' => $request->input('title'),
                        // 'icon' => $request->input('iconselect'),
                        'icon' => 'fa-calendar',
                        'booking_status' => $request->input('booking_status'),
                        'description' => $request->input('description'),
                        'start' => $request->input('starting'),
                        'end' => $enddate,
                    ]);
                $booking->save(); 
                // Session::flash('inserted', 'Booked successfully...');
                // return redirect('bookings');  
                return response()->json([
                        'result' => true,
                        'msg' => 'inserted', 'Booked successfully...',
                        'callback' => 'abc'
                    ]);       
            }catch(Exception $ex){    

            }
         }
      
        if($request->input('cmd_submit')=="Update"){
            $validator = Validator::make($request->all(), [
                'booking_status' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);  
            if($validator->fails()) {
              return response()->json([
                        'result' => false,
                        'msg' => 'Please check your field before submiting',
                        'errors' => $validator->errors()
                    ]);
            }  
            try{
                $enddate = date_create($request->input('ending')); // For today/now, don't pass an arg.
                $enddate->modify("+1 day");
                $booking_id=$request->cmd_id;  
                Bookings::where('id', decrypt($booking_id))->update([
                        'guide_id' => $guide_id,
                        'creator_id' => $creator_id,
                        // 'lang_id' => ,
                        'active' => 'active',
                        'title' => $request->input('title'),
                        'booking_status' => $request->input('booking_status'),
                        // 'icon' => $request->input('iconselect'),
                        'description' => $request->input('description'),
                        'start' => $request->input('starting'),
                        'end' => $enddate,
                    ]);
                // Session::flash('updated', 'Updated successfully...');  
                return response()->json([
                        'result' => true,
                        'msg' => 'updated', 'Updated successfully...',
                         'callback' => 'abc',
                    ]);       
            }catch(Exception $ex){    

            }
        }
        //end Button Update
      
        
    }
     public function ajx_edit(Request $request)
    {

        // if(!Auth::user()->authorized('content_terms')) {
        //     abort(403, 'Unauthorized action.');
        // }
     
         
        try{
            $id=decrypt($request->id);
            $booking=Bookings::find($id) ;
            $booking=array(
                            'id'=>encrypt($booking->id),
                                    'title'=>$booking->title,
                                    'active'=>$booking->active,
                                    'description'=>$booking->description,
                                    'booking_status'=>$booking->booking_status,
                                    'icon'=>$booking->icon,
                                    'start'=>$booking->start,
                                    'user_login' => User::getUserLogin(),
                                    // 'backgroundColor' => $bg,
                                    'end'=>$booking->end
                            );
            return response()->json([
                    'result' => true,
                    'msg' => 'inserted', 'Booked successfully...',
                    'booking' => $booking,
                ]);       
        }catch(Exception $ex){    

        }
    }
}
