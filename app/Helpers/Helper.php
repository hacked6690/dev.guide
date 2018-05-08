<?php

namespace App\Helpers;

use Session;
use Auth;
use Carbon\Carbon;
use File;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class Helper
{
	// __________________________________ Here ↓ are custom functions ;

	public static function filesize($bytes, $dec = 2)
	{
	    $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	    $factor = floor((strlen($bytes) - 1) / 3);

	    return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
	}

	public static function client_ip()
	{
	    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
	    {
	        if (array_key_exists($key, $_SERVER) === true)
	        {
	            foreach (explode(',', $_SERVER[$key]) as $ip)
	            {
	                $ip = trim($ip); // just to be safe

	                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
	                {
	                    return $ip;
	                }
	            }
	        }
	    }
	}

	public static function layout()
	{
		return \Layout::translated(Session::get('locale'));
	}

	public static function menu_tree($objs =null, $where = ['parent' => 0], $sort_by = ['sort_by' => 'ordered'])
	{
		$current_uri = '/'. Route::current()->uri();

		$str_navigated = '';

		$first = $objs->filter(function ($obj) use ($where, $sort_by) {
		                    return $obj->parent == $where[key($where)];
		                })->sortBy($sort_by[key($sort_by)]);

		if(!$first->isEmpty())
		{
			foreach ($first as $key => $value)
			{
				$next = (object) $value;

				$chld = $objs->filter(function ($obj) use ($next, $sort_by) {
			                    return $obj->parent == $next->id;
			                })->sortBy($sort_by[key($sort_by)]);

				if(!$chld->isEmpty())
				{
					$str_navigated .='<li>
	                                        <a href="#" title="'. $next->title .'">
	                                            '. $next->icon .' <span class="menu-item-parent">'. $next->title .'</span>
	                                        </a>
											<ul>
												'. self::menu_tree($objs, ['parent' => $next->id]) .'
											</ul>
	                                    </li>';
				} else {

					if($next->url =='/profiles')
					{
						$next->url = route('profiles.edit', encrypt(Auth::user()->id));
					}

					$str_navigated .='<li '. ($current_uri == $next->url ? 'class="active"' :'') .'>
	                                        <a href="'. $next->url .'" title="'. $next->title .'">
	                                            '. $next->icon .' <span class="menu-item-parent">'. $next->title .'</span>
	                                        </a>
	                                    </li>';
				}
			}
		}

		return self::rtn($str_navigated);
	}

	public static function obj_tree($objs =null, $where = ['parent' => 0], $sort_by = ['sort_by' => 'ordered'])
	{
		$tree = [];

		$first = $objs->filter(function ($obj) use ($where, $sort_by) {
		                    return $obj->parent == $where[key($where)];
		                })->sortBy($sort_by[key($sort_by)]);

		if(!$first->isEmpty())
		{
			foreach ($first as $key => $value)
			{
				$next = (object) $value;

				$chld = $objs->filter(function ($obj) use ($next, $sort_by) {
			                    return $obj->parent == $next->id;
			                })->sortBy($sort_by[key($sort_by)]);

				if(!$chld->isEmpty())
				{
					$tree[$next->slug] = self::obj_tree($objs, ['parent' => $next->id]);

				} else {
					$tree[$next->slug] = $next;
				}
			}
		}

		return $tree;
	}

	public static function indexed($items, $key)
	{
		return ($items->perPage() * ($items->currentPage() -1)) + ($key +1);
	}

	// Need fixex : if meta_value is number ; ex: number of children,
	// and this number matched term_id (content_terms)
	// Mean while if matched, just ignor it.
	// Since we just get meta_value, not content_terms title
	public static function metas($table ='user_meta', $where = ['user_id' => 0], $meta =['except' => ''])
	{
		$qry = DB::table($table)
				->select("{$table}.*", 'content_terms.*')
				->leftJoin('content_terms', "{$table}.meta_key", '=', 'content_terms.term_id')
				->where(function($query) use ($table, $where, $meta) {
					if($meta[key($meta)] !='') {
						if(key($meta) =='except') {
							$query->where("{$table}.". key($where), '=', $where[key($where)])
									->whereNotIn("{$table}.meta_key", array($meta[key($meta)]));

						} else if(key($meta) =='only') {
							$query->where("{$table}.". key($where), '=', $where[key($where)])
									->whereIn("{$table}.meta_key", array($meta[key($meta)]));
						}
					} else {
						$query->where("{$table}.". key($where), '=', $where[key($where)]);
					}
				})
				->get();

		if(count($qry))
		{
			$obj = new \stdClass();

			foreach ($qry as $key => $value)
			{
				$obj->{$value->meta_key} = (object) array(
												'term_id' => $value->term_id,
												'slug' => $value->slug,
												'value' => $value->meta_value,
												'title' => $value->title
											);
			}

			return $obj;
		}

		return null;
	}

	public static function store_meta($table = 'user_meta', $where = ['user_id' => [0]], $meta = [], $use_existed = [], $return =false)
	{
		// check if $meta is array [] => associated
		if(!is_array($meta))
			return false;

		// need to filter `display_name`, it Required
		// this one need further fixed
		$use_existed = array_unique($use_existed);

		/* check if tmp_meta exist */
		$tmp_meta = self::metas($table, [key($where) => $where[key($where)]]);
		$tmp_meta = is_null($tmp_meta) ? new \stdClass() :$tmp_meta;

		$existed_metakey = array_keys((array) $tmp_meta);
		$metakey = array_keys($meta);

		// remove existed meta - which not in updated meta
		// ex: existed 3, now 2 metas ;
		$removed = array();

		foreach ($existed_metakey as $key => $value)
		{
			if(!in_array($value, $metakey))
			{
				if(!in_array($value, $use_existed))
				{
					array_push($removed, $value);
				}
			}
		}

		if(count($removed) !=0)
		{
			self::removed_only($table, [key($where) => $where[key($where)]], $removed);
		}

		// create str meta_key & meta_value ;
		$data =[];

		foreach ($meta as $key => $value)
		{
			$now = Carbon::now('utc')->toDateTimeString();

			// this for excepted meta `
			if($value =='' AND in_array($key, $use_existed) AND is_object($tmp_meta) AND property_exists($tmp_meta, $key) AND $tmp_meta->{$key}->value !='')
			{
				$tmp = array(
						key($where) => $where[key($where)],
						'meta_key' => $key,
						'meta_value' => $tmp_meta->{$key}->value
					);

				if(Schema::hasColumn($table, 'created_at') AND Schema::hasColumn($table, 'updated_at'))
				{
					$tmp['created_at'] = $now;
					$tmp['updated_at'] = $now;
				}

				$data[] = $tmp;

			} else {

				if(!property_exists($tmp_meta, $key) OR property_exists($tmp_meta, $key) AND $value !== $tmp_meta->{$key}->value)
				{
					$tmp = array(
							key($where) => $where[key($where)],
							'meta_key' => $key,
							'meta_value' => $value
						);

					if(Schema::hasColumn($table, 'created_at') AND Schema::hasColumn($table, 'updated_at'))
					{
						$tmp['created_at'] = $now;
						$tmp['updated_at'] = $now;
					}

					$data[] = $tmp;

				} else if (property_exists($tmp_meta, $key) AND $value == $tmp_meta->{$key}->value) {
					$metakey = array_diff($metakey, [$key]);
				}
			}
		}

		if(count($data) !=0)
		{
			/* remove existed meta */
			self::removed_only($table, [key($where) => $where[key($where)]], $metakey);

			/* store new meta */
			return DB::table($table)->insert($data);
		}

		return false;
	}

	public static function removed_only($table ='user_meta', $where =['user_id' => 0], $meta_key =[])
	{
		if(!is_array($meta_key))
			return false;

		$qry = DB::table($table)
					->where(function($query) use ($where, $meta_key) {
						$query->where(key($where), '=', $where[key($where)])
							->whereIN('meta_key', $meta_key);
					})
					->delete();

		return $qry ? true :false;
	}

	public static function rollback_meta($table ='user_meta', $where =['user_id' => [0]])
	{
		$qry = DB::table($table)
					->whereIN(key($where), $where(key($where)))
					->delete();

		return $myqry ? true :false;
	}

	public static function rollback($table ='user', $where =['id' => [0]])
	{
		$qry = DB::table($table)
					->whereIN(key($where), $where(key($where)))
					->delete();

		return $qry ? true :false;
	}

	// Ex: UserMetas::where('user_id', 7)->get()->toArray() to Object ;

	public static function objmeta($arr_metas, $key = ['key' => 'meta_key'], $value = ['value' => 'meta_value'])
	{
		$metas = array();

		foreach ($arr_metas as $meta)
		{
			$obj = (object) $meta;
			$metas[$obj->{$key[key($key)]}] = $obj->{$value[key($value)]};
		}

		return (object) $metas;
	}

	public static function rtn($string)
	{
		return preg_replace("/[\r\n\t]/", '', $string);
	}

	public static function enzerialize($multidimensional_array)
	{
		return base64_encode(serialize($multidimensional_array));
	}

	public static function dezerialize($encoded_serialized_string)
	{
		return unserialize(base64_decode($encoded_serialized_string));
	}


	// ________________________________________ Here are function with html tag ;

	public static function paginator($route =['route' => 'posts'], $items =['items' => null], $display =['display' =>7])
	{
		$pages = array(7 => '7 default', 25 => '25', 50 => '50', 75 => '75', 125 => '125');

		$str_paginate ='';

		foreach($pages as $key => $page)
		{
			$str_paginate .='<option value="'. $key .'" '. ($key ==$display[key($display)] ? 'selected' :'') .'>'. $page .'</option>';
		}

		$str_navigated = '<form action="'. route($route[key($route)] .'.index') .'" class="smart-form" method="get">
									<div class="row custom-paginated">
										<section class="col col-2">
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="display" onchange="this.form.submit();">

													'. self::empty_option('Display') .'

													'. $str_paginate .'

												</select><i></i>
											</label>
										</section>
										<section class="col col-10">
											<label class="input pull-right">

												'. $items[key($items)]->appends(['display' => $display[key($display)]])->links() .'

											</label>
										</section>
									</div>
								</form>';

		return $str_navigated;
	}
	public static function paginator_fr($route =['route' => 'posts'], $items =['items' => null], $display =['display' =>7])
	{
		$pages = array(7 => '7 default', 25 => '25', 50 => '50', 75 => '75', 125 => '125');

		$str_paginate ='';

		foreach($pages as $key => $page)
		{
			$str_paginate .='<option value="'. $key .'" '. ($key ==$display[key($display)] ? 'selected' :'') .'>'. $page .'</option>';
		}

		$str_navigated = '<form action="'. route($route[key($route)] .'.index') .'" id="sky-form4" class="sky-form" class="smart-form" method="get">
									<div class="row custom-paginated">
										<section class="col col-3">
											<label class="select">
												<select class="input-sm border-0 border-bottom-1" name="display" onchange="this.form.submit();">

													'. self::empty_option('Display') .'

													'. $str_paginate .'

												</select><i></i>
											</label>
										</section>
										<section class="col col-9">
											<label class="input pull-right">
												'. $items[key($items)]->appends(['display' => $display[key($display)]])->links() .'
											</label>
										</section>
									</div>
								</form>';

		return $str_navigated;
	}

	public static function empty_option($custom_text ='')
	{
		return '<option value>&mdash; '. ($custom_text =='' ? self::layout()->label->select->title : $custom_text) .' &mdash;</option>';
	}

	public static function empty_table($column =2)
	{
		return self::rtn('<tr class="empty-tr text-center">
									<td colspan="'. $column .'" class="">
										'. self::layout()->label->no_data_found->icon .' <span class="font-13">'. self::layout()->label->no_data_found->title  .'</span>
									</td>
								</tr>');
	}

	public static function alert($type ='danger', $message ='Error', $class ='inline-block')
	{
		return self::rtn('<div class="msg font-light">
									<div class="alert alert-'. $type .' fade in font-12 line-height-13 '. $class .'">
										<button class="close line-height-12" data-dismiss="alert">×</button>
										'. $message .'
									</div>
								</div>');
	}
	public static function MyFormatDate($date)
	{
		$date=date_create($date);
       return $date=date_format($date,"Y-m-d");
	}
}


