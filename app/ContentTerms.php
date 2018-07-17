<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContentTerms extends Model
{
	public $timestamps = false;
    
    protected $fillable = [
    	'slug',
    	'title',
    ];

    public static function getTermTitle($id)
    {
        $term= ContentTerms::where('term_id','=',$id)->first();
        return $term->title;
    }
    public static function terms_by($where =['taxonomy' => 'label'])
    {
        $cols_terms = Schema::getColumnListing('content_terms');
        $cols_taxonomy = Schema::getColumnListing('content_taxonomy');

    	$terms = DB::table('content_terms')
                    ->select(
                        'content_terms.*',
                        'content_taxonomy.taxonomy',
                        'content_taxonomy.parent as parent'
                    )
                    ->join('content_taxonomy', function($join) use ($where, $cols_taxonomy) {

                        $join->on('content_terms.term_id', '=', 'content_taxonomy.term_id');

                        if(in_array(key($where), $cols_taxonomy))
                        	$join->where('content_taxonomy.'. key($where), '=', $where[key($where)]);
                    })
                    ->where(function($query) use ($where, $cols_terms) {

                        if(in_array(key($where), $cols_terms))
                            $query->where('content_terms.'. key($where), '=', $where[key($where)]);
                    })
                    ->orderBy('content_terms.title', 'asc')
                    ->get();

	    return $terms;
    }

    public static function opt_by($where =['taxonomy' => 'label'])
    {
        $terms = self::terms_by($where);

        $str_opt = '';

        if(!is_null($terms))
        {
            foreach ($terms as $term)
            {
                $str_opt .='<option value="'. $term->term_id .'">'. $term->title .'</option>';
            }
        }

        return $str_opt;
    }
}
