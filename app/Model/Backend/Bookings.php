<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;
use App\ContentTerms;
class Bookings extends Model
{
    //
     protected $table = 'bookings';

    protected $fillable = [
    	'guide_id',
    	'lang_id',
    	'creator_id',
    	'title',
        'description',
        'active',
        'start',
        'end',
        'icon',
        'booking_status',
    ];

    public static function booking_history($guide_id,$num_per_page,$booking_status="booking"){
    	  $listings=Bookings::where('guide_id',$guide_id)
                     ->where('active','=','active')
                     ->where('booking_status','=',Bookings::statusID($booking_status))
                    ->orderBy('start','desc')
                    ->paginate($num_per_page);
            return $listings;
    }
    public static function list_bookings($guide_id){
    	return Bookings::where('guide_id',$guide_id)->where('active','=','active')->orderBy('start','asc')->get();
    }
    public static function statusID($str="event"){
    		  $booking_status= ContentTerms::terms_by(['taxonomy' => 'booking_status']); 
    		  foreach ($booking_status as $b) {
    		  	if($b->slug==$str){
    		  		return $b->term_id;
    		  	}
    		  }
    }
      public static function statusName($id=74){
              $booking_status= ContentTerms::terms_by(['taxonomy' => 'booking_status']); 
              foreach ($booking_status as $b) {
                if($b->term_id==$id){
                    return $b->title;
                }
              }
    }
    public static function upcoming($status='booking',$guide_id){
         $booking_status= ContentTerms::terms_by(['taxonomy' => 'booking_status']); 
         $term_id=null; 
         foreach ($booking_status as $bs) {
             if($bs->slug==$status){
                $term_id= $bs->term_id;
                break;
             }
         }
         $upcoming=Bookings::where('booking_status','=',$term_id)
                     ->where('active','=','active')
                     ->where('guide_id','=',$guide_id)
                     ->whereDate('start', '>=', date('Y-m-d'))
                     ->orderBy('start','asc')
                     ->limit(5)
                     ->get();
          return $upcoming;
    }
     public static function events($guide_id){     
       $booking_status= ContentTerms::terms_by(['taxonomy' => 'booking_status']);   
            


 
        $list_bookings=Bookings::list_bookings($guide_id);
        $booking_custom=[];
        foreach ($list_bookings as $lb) {
            // echo $lb->end."------>".$lb->end."-----";
        		if($lb->booking_status==$booking_status[0]->term_id){
	                $bg="red";
	            }else{
	                $bg="gray";
	            }

            
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
                        'backgroundColor' => $bg,
                        'end'=>$enddate
                        );
        }
        
        $list_bookings=$booking_custom;       
        return $list_bookings;
    }

}
