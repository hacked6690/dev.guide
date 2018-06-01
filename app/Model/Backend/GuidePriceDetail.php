<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class GuidePriceDetail extends Model
{
    //
      protected $table = 'guideprice_detail';

    protected $fillable = [
    	'gp_price',
    	'fee_id',
    	'gp_id',
    ];

     // DEFINE RELATIONSHIPS --------------------------------------------------
    public function guide_price() {
        return $this->belongsTo('App\GuidePrice');
    }
     public function getFeeAttribute(){    
        return \App\ContentTerms::where('term_id', $this->fee_id)->first();
    }

    
}
