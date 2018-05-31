<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class GuidePrice extends Model
{
    protected $table = 'guide_price';

    protected $fillable = [
    	'guide_id',
    	'language_id',
    	'province_id',
    	'price',
        'default',
        'active',
    ];
    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function user() {
        return $this->belongsTo('App\User');
    }
     public function guideprice_detail(){
        return $this->hasMany('App\Model\Backend\GuidePriceDetail', 'gp_id');
    }



    public function getLanguageAttribute(){    
        return \App\ContentTerms::where('term_id', $this->language_id)->first();
    }
     public function getProvinceAttribute(){    
        return \App\ContentTerms::where('term_id', $this->province_id)->first();
    }



    public static function getLanguagesAPI(){
       return  ContentTerms::terms_by(['taxonomy' => 'languages']);
    }
     public static function getProvincesAPI(){
       return  ContentTerms::terms_by(['taxonomy' => 'provinces']);
    }

    public static function countGP($language_id,$province_id,$guide_id)
    {
         $count=DB::table('guide_price')
            ->where('language_id',$language_id)
            ->where('province_id',$province_id)
            ->where('guide_id',$guide_id)
            ->count();
        return $count;
    }
    public static function countGPDefault($guide_id)
    {
         $countDefault=DB::table('guide_price')
            ->where('default','yes')
            ->where('guide_id',$guide_id)
            ->count();
        return $countDefault;
    }

}
