<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LayoutItems extends Model
{
    protected $fillable = [
    	'category_id',
    	'slug',
    	'title',
    	'url',
    	'icon',
        'ordered',
    	'description',
    	'options',
    	'parent',
    ];

    public static function by_category($where =['slug' => 'admin_menu'])
    {
        $cols_layout_category = Schema::getColumnListing('layout_categories');

        $items = DB::table('layout_items as li')
                        ->select('li.*')
                        ->leftJoin('layout_categories as lc', 'li.category_id', '=', 'lc.id')
                        ->leftJoin('layout_item_translates as lit', 'li.id', '=', 'lit.item_id')
                        ->groupBy('li.id')
                        ->where(function($query) use ($where, $cols_layout_category) {

                            if(in_array(key($where), $cols_layout_category))
                                $query->where('lc.'. key($where), '=', $where[key($where)]);
                        })
                        ->orderBy('li.id', 'desc');

        return $items;
    }
}
