<?php

namespace App;

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

}
