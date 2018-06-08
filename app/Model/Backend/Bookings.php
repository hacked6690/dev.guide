<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

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
    ];

    public static function list_bookings($guide_id){
    	return Bookings::where('guide_id',$guide_id)->where('active','=','active')->orderBy('start','asc')->get();
    }
}
