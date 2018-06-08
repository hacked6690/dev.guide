<?php

namespace App\Http\Controllers\backend;
use Auth;
use Session;
use App\Model\Backend\Bookings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class CalendarsBooking extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_bookings=Bookings::list_bookings(Auth::user()->id);
        $booking_custom=[];
        foreach ($list_bookings as $lb) {
            // echo $lb->end."------>".$lb->end."-----";

                $enddate = date_create($lb->end); // For today/now, don't pass an arg.
                // $enddate->modify("-1 day");
               $enddate=$enddate->format("Y-m-d");

            $booking_custom[]=array(
                        'id'=>encrypt($lb->id),
                        'title'=>$lb->title,
                        'active'=>$lb->active,
                        'description'=>$lb->description,
                        'icon'=>$lb->icon,
                        'start'=>$lb->start,
                        'end'=>$enddate
                        );
        }
        // dd('x');
        $list_bookings=$booking_custom;
        // echo json_encode($list_bookings);
        // dd($list_bookings);
        return view('backend.calendarsbooking.index',compact(['list_bookings']));
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
    public function ajx_delete(Request $request)
    {
        $decrypted_id=$request->input('cmd_id');
        // $decrypted_id = decrypt($id);
        $gpDetail = Bookings::where('id', $decrypted_id)->limit(1);
        $gpDetail->delete();
        Session::flash('deleted', "Booking is deleted");
         return response()->json([
                        'result' => true,
                        'msg' => 'deleted', 'Deleted successfully...',
                    ]);  
    }
      public function ajx_store(Request $request)
    {
         $guide_id=Auth::user()->id;
         $creator_id=Auth::user()->id;
         
        
        if($request->input('cmd_submit')=="Save"){
            try{
                $validator = Validator::make($request->all(), [
                    'iconselect' => 'required',
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
                        'icon' => $request->input('iconselect'),
                        'description' => $request->input('description'),
                        'start' => $request->input('starting'),
                        'end' => $enddate,
                    ]);
                $booking->save(); 
                Session::flash('inserted', 'Booked successfully...');
                // return redirect('bookings');  
                return response()->json([
                        'result' => true,
                        'msg' => 'inserted', 'Booked successfully...',
                    ]);       
            }catch(Exception $ex){    

            }
         }
      
        if($request->input('cmd_submit')=="Update"){
            $validator = Validator::make($request->all(), [
                'iconselect' => 'required',
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
                        'icon' => $request->input('iconselect'),
                        'description' => $request->input('description'),
                        'start' => $request->input('starting'),
                        'end' => $enddate,
                    ]);
                Session::flash('updated', 'Updated successfully...');  
                return response()->json([
                        'result' => true,
                        'msg' => 'updated', 'Booked successfully...',
                    ]);       
            }catch(Exception $ex){    

            }
        }
        //end Button Update
      
        
    }
     public function ajx_edit(Request $request)
    {
        try{
            $id=decrypt($request->id);
            $booking=Bookings::find($id) ;
            $booking=array(
                            'id'=>encrypt($booking->id),
                                    'title'=>$booking->title,
                                    'active'=>$booking->active,
                                    'description'=>$booking->description,
                                    'icon'=>$booking->icon,
                                    'start'=>$booking->start,
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
