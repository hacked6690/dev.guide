<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Session;
use Auth;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers ;
        View::composer('layouts.admin.partials.aside', function ($view) {

            // string navigated ;
            $layout_items = \App\LayoutItems::with('category','translate.language')
            ->whereHas('category', function($query){
                $query->where('slug','menu');
            })
            ->get()->keyBy('slug');



            //dd($layout_items);
            // top tree of admin menu ;
            $parent = $layout_items->pull('admin_menu');

            $privileges = Auth::user()->role->privileges;

            // show only item[s] taht 's in parent ;
            $objs = $layout_items->filter(function ($value, $key) use ($privileges) {
                // dd($value->title);
                if($value->translate!==null){
                    $filter=$value->translate->each(function ($l_value, $l_key) use($value) {
                        // dd($l_value);
                        if($l_value->language->slug==Session::get('locale')){
                            $value->title = $l_value->title;
                        }
                    });
                 }



                                    return in_array(str_replace('all_', '', $value->slug), $privileges->pluck('slug')->toArray());
                                });

            $str_navigated = $parent ? \Helper::menu_tree($objs, ['parent' => $parent->id]) :'';

            $navigated ='<nav>
                            <ul>
                                '. $str_navigated .'
                            </ul>
                        </nav>';

            // user meta ;
            $user_meta = Auth::check() ? \App\UserMetas::where('user_id', Auth::user()->id)->get() :null;
            $user_meta = !is_null($user_meta) ? \Helper::objmeta($user_meta) :null;

            $view->with([
                    'navigated' => $navigated,
                    'user_id' => Auth::user()->id,
                    'user_meta' => $user_meta
                ]);
        });


        // partials.header ;
        View::composer('layouts.admin.partials.header', function ($view) {

            $languages = \App\Languages::where('status', 1)->get();

            $active_languaged = $str_languaged ='';

            $locale = Session::has('locale') ? Session::get('locale') :app()->getLocale();

            foreach ($languages as $key => $value)
            {
                if($locale ==$value['slug'])
                {
                    $active_languaged = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                '. $value['icon'] .' <span> '. $value['title'] .' </span> <i class="fa fa-angle-down"></i>
                                            </a>';
                }

                $str_languaged .= '<li>
                                        <a href="'. route('languages.set', encrypt($value['id'])) .'">
                                            <span>'. $value['icon'] .' '. $value['title'] .'</span>
                                        </a>
                                    </li>';
            }

            $languaged = '<ul class="header-dropdown-list hidden-xs">
                                <li>
                                    '. $active_languaged .'
                                    '. (count($languages) >1 ? '<ul class="dropdown-menu pull-right">'. $str_languaged .'</ul>' :'') .'
                                </li>
                            </ul>';

            $view->with('languaged', $languaged);
        });


        // partials.header frontend ;
        View::composer('layouts.frontend.partials.header', function ($view) {

            $languages = \App\Languages::where('status', 1)->get();

            $active_languaged = $str_languaged ='';

            $locale = Session::has('locale') ? Session::get('locale') :app()->getLocale();

            foreach ($languages as $key => $value)
            {
                if($locale ==$value['slug'])
                {
                   /* $active_languaged = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                '. $value['icon'] .' <span> '. $value['title'] .' </span> <i class="fa fa-angle-down"></i>
                                            </a>';*/
                     $active_languaged = '<a href="#" >
                                                '. $value['icon'] .' <span> '. $value['title'] .' </span> <i class="fa fa-angle-down"></i>
                                            </a>';
                }

                $str_languaged .= '<li>
                                        <a href="'. route('languages.set', encrypt($value['id'])) .'">
                                            <span>'. $value['icon'] .' '. $value['title'] .'</span>
                                        </a>
                                    </li>';
            }

          


            $languaged_fr='<li class="hoverSelector">
                            <i class="fa fa-globe"></i>
                            '. $active_languaged .'
                            <ul class="languages hoverSelectorBlock">                               
                                '. (count($languages) >1 ? ''. $str_languaged .'' :'') .'
                            </ul>
                        </li>     '; 
           

            $view->with('languaged_fr', $languaged_fr);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once(app_path() . '/Helpers/Helper.php');
        require_once(app_path() . '/Helpers/Layout.php');
    }
}
