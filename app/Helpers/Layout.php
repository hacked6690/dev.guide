<?php

namespace App\Helpers;

use App\Languages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Layout
{
	public static function translated($language_slug ='kh')
	{
		$language = Languages::where('slug', $language_slug)->first();

		$qry = DB::table('layout_items as li')
					->select(
						'li.id as li_id',
						'li.slug as li_slug',
						DB::raw('CONCAT(UCASE(MID(li.title, 1, 1)), MID(li.title, 2)) as li_title'),
						'lit.title as lit_title',
						'li.url as li_url',
						'li.icon as li_icon',
						'li.ordered as li_ordered',
						'li.description as li_description',
						'li.options as li_options',
						'li.parent as li_parent',
						'lc.id as lc_id',
						'lc.slug as lc_slug')
					->leftJoin('layout_item_translates as lit', function($join) use ($language) {
						$join->on('li.id', '=', 'lit.item_id');
						$join->where('lit.language_id', '=', $language->id);
					})
					->leftJoin('languages', function($join) use ($language_slug) {
						$join->on('lit.language_id', '=', 'languages.id');
						$join->where('languages.slug', '=', $language_slug);
					})
					->leftJoin('layout_categories as lc', 'li.category_id', '=', 'lc.id')
					->orderBy('lc.id', 'asc')
					->get()->toArray();


		$lc_obj = $li_obj = array();
		$last_lc_id = $last_li_id ='';

		foreach($qry as $tkey => $tvalue)
		{
			$last_lc_id = $tvalue->lc_id;
			$last_li_id = $tvalue->li_id;

			if(!array_key_exists($last_lc_id, $lc_obj))
			{
				$lc_obj[$last_lc_id] = (object) array(
											'id' => $last_lc_id,
											'slug' => $tvalue->lc_slug
										);
			}

			$li_obj[$last_lc_id][$tvalue->li_id] = (object) array(
														'id' => $tvalue->li_id,
														'slug' => $tvalue->li_slug,
														'title' => $tvalue->li_title,
														'translated' => $tvalue->lit_title,
														'url' => $tvalue->li_url,
														'icon' => $tvalue->li_icon,
														'ordered' => $tvalue->li_ordered,
														'description' => $tvalue->li_description,
														'options' => $tvalue->li_options,
														'parent' => $tvalue->li_parent,
													);
		}

		$labels = array();

		foreach($lc_obj as $cate_key => $cate_value)
		{
			$category_id = $cate_value->id;
			$new_key = $cate_value->slug;

			$item_arr = array();

			foreach($li_obj[$category_id] as $item_key => $item_value)
			{
				if(!empty($item_value->translated))
				{
					$item_value->title = $item_value->translated;
				}

				$item_arr[strtolower($item_value->slug)] = (object) $item_value;
			}

			$labels[$new_key] = (object) $item_arr;
		}

		return (object) $labels;
	}


	public static function language()
	{
		$language_id ='';
		$language_slug ='';

		if(isset($_GET['url']))
		{
			$url_text = $_GET['url'];
			$url_parameters = explode("/", $url_text);

			// check if the language code is set in the url
			// if yes, store it and remove from the array
			if(strlen($url_parameters[0]) ==2)
			{
				$language_slug = $url_parameters[0];
				unset($url_parameters[0]);
				$url_parameters = array_values($url_parameters);
			}
		}

		$qry = DB::table('languages')
					->select('id', 'slug', 'title', 'set_default')
					->get();

		$arr_languages = array();
		$language_selected = '';

		if(count($qry) >0)
		{
			foreach($qry as $key => $value)
			{
				$selected = false;

				if($value->slug == $language_slug)
				{
					$selected = true;
					$language_selected = $value->slug;
					$language_id = $value->id;
				}

				$arr_languages[$value->slug] = (object) array(
								'id' => $value->id,
								'slug' => $value->slug,
								'title' => $value->title,
								'selected' => $selected
							);
			}

			// get default language
			if($language_selected =='')
			{
				foreach($qry as $key => $value)
				{
					if($value->set_default ==1)
					{
						$language_selected = $value->slug;
					}
				}
			}
		}

		return (object) array(
					'id' => $language_id,
					'obj' => (object) array(
						'selected' => $language_selected,
						'get_list' => (object) $arr_languages
					)
				);
	}
}