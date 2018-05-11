<?php 
use App\Http\Controllers\frontend\GuidesController; 
use App\User; 
use Illuminate\Support\Facades\Storage;
?>
<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#c2d6d6">
    <form action="{{ route('guides.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="get"  >
        <div class="col-lg-2 col-md-2 col-xs-12">
                <section class="flexibled-error">
                    <label class="label">
                        {{ $layout->label->fullname_en->title }} 
                        @if($errors->has('fullname_en'))
                            <div class="error-badge" id="for-fullname_en">
                             {!! Helper::alert('danger', $errors->first('fullname_en')) !!}
                             </div>
                       @endif
                    </label>
                    <label class="input">
                        <input type="text" value="{{ old('fullname_en') }}" name="fullname_en" placeholder="Guide name">
                    </label>
                </section>
        </div>
    
        <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                    <label class="label">
                        {{ $layout->label->gender->title }} 
                        @if($errors->has('gender'))
                            <div class="error-badge" id="for-gender">
                             {!! Helper::alert('danger', $errors->first('gender')) !!}
                             </div>
                       @endif
                    </label>
                    <label class="select">
                       <select value="{{ old('gender') }}" name="gender" >
                           <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                              @foreach($genders as $gender)
                                   @if(old('gender') ==$gender->term_id)
                                      <option value="{{$gender->term_id}}" selected >{{$gender->title}}</option>
                                   @else
                                      <option value="{{$gender->term_id}}">{{$gender->title}}</option>
                                  @endif
                              @endforeach
                      </select>
                      <i></i>
                    </label>
        </section>       
        <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                <label class="label">
                       {{ $layout->label->guide_type->title }}
                            @if($errors->has('guide_type_id'))
                                <div class="error-badge" id="for-guide_type_id">                                                            
                                    {!! Helper::alert('danger', $errors->first('guide_type_id')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('guide_type_id') }}" name="guide_type_id" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($guide_types as $guide_type)
                                 @if(old('guide_type_id') ==$guide_type->term_id)
                                    <option value="{{$guide_type->term_id}}" selected >{{$guide_type->title}}</option>
                                 @else
                                    <option value="{{$guide_type->term_id}}">{{$guide_type->title}}</option>
                                @endif
                            @endforeach
                    </select>
                    <i></i>
               </label>
        </section> 
         <section class="col col-lg-2 col-md-2 col-xs-12 flexibled-error">
                <label class="label">
                       {{ $layout->label->nationality->title }}
                            @if($errors->has('nationality'))
                                <div class="error-badge" id="for-nationality">                                                            
                                    {!! Helper::alert('danger', $errors->first('nationality')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('nationality') }}" name="nationality" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($nationalities as $nationality)
                                 @if(old('nationality') ==$nationality->term_id)
                                    <option value="{{$nationality->term_id}}" selected >{{$nationality->title}}</option>
                                 @else
                                    <option value="{{$nationality->term_id}}">{{$nationality->title}}</option>
                                @endif
                            @endforeach
                    </select>
                    <i></i>
               </label>
        </section> 
        <section class="col col-lg-3 col-md-3 col-xs-12 flexibled-error">
                <label class="label">
                       {{ $layout->label->language->title }}
                            @if($errors->has('guide_language'))
                                <div class="error-badge" id="for-guide_language">                                                            
                                    {!! Helper::alert('danger', $errors->first('guide_language')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('guide_language') }}" name="guide_language" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($guide_languages as $guide_language)
                                 @if(old('guide_language') ==$guide_language->term_id)
                                    <option value="{{$guide_language->term_id}}" selected >{{$guide_language->title}}</option>
                                 @else
                                    <option value="{{$guide_language->term_id}}">{{$guide_language->title}}</option>
                                @endif
                            @endforeach
                    </select>
                    <i></i>
               </label>
        </section>  
        <section class="col col-lg-1 col-md-1 col-xs-12 flexibled-error">
                <button type="submit"  class="btn-u" style="width:100%;margin-top:25px">
                    <span class="button_search"><i class="fa fa-search"></i></span>
                 </button>   
        </section>    
    </form>                                 
                                            
</div>


<?php

foreach ($users as $user) {
  $uid=$user->id;
  $uemail=$user->email;  

$user_meta=Helper::metas('user_meta',['user_id' => $uid] );
$photo_path='';
$file=Storage::url('guide_profile_test/' . $user_meta->photo->value);
if(!file_exists($file)){
    $photo_path=Storage::url('guide_profile_test/' . $user_meta->photo->value);
}


 $photo_path;
$date1=new DateTime($user_meta->dob->value);
$date_2 = new DateTime( date( 'Y-m-d' ) );
$difference = $date_2->diff( $date1);
$age= $difference->y;
$profileID=Helper::encodeString($uid,Helper::encryptKey());
// $profileID=$uid;

 
echo '
  <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <a href="/guides/detail/'.$profileID.'">
                        <img src="'. $photo_path .'" alt="Guide"
                            class="img-rounded img-responsive guideprofile" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-8 section-box">
                        <h2 class="text text-info">
                             <a href="/guides/detail/'.$profileID.'">'.$user_meta->fullname_en->value.'</a>
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <span class="glyphicon glyphicon-comment"></span>(100 Comments)
                                </span>                               
                        </h2>
                        <p>
                            '.$layout->label->nationality->title.': '.$user_meta->nationality_id->title.' 
                            | '.$layout->label->date_of_birth->title.':'.$user_meta->dob->value.' 
                            | '.$layout->label->gender->title.': '.$user_meta->gender->title.' 
                            | '.$layout->label->guide_type->title.': '.$user_meta->guide_type_id->title.'  
                        </p>
                         <p>
                            '.$layout->label->location->title.': '.$user_meta->province_id->title.' | '.$layout->label->language->title.': '.$user_meta->language_id->title.'  
                        </p>
                        <p>
                            '.$layout->label->number_of_booking->title.': <b>34</b> BOOKINGS
                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price"><b>'.$user_meta->guide_price->value.'</b> '.$layout->label->usd->title.'</h3>
                        <em class="perday">'.$layout->label->per_day->title.'</em>
                    </div>
                </div>
            </div>
    </div>
    ';



}

?>






<div class="table-footer">
    {!! \Helper::paginator_fr(['route' => 'guides'], ['items' => $users], ['display' => $display]) !!}
</div>


                                    