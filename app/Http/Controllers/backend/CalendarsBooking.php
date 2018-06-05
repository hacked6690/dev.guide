<?php

namespace App\Http\Controllers\backend;

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
        return view('backend.calendarsbooking.index');
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
      public function ajx_store(Request $request)
    {

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
        //Check Data to verify distinct value
       /* $count=DB::table('guideprice_detail')
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
      */
        
    }
}
