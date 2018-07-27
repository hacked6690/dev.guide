<?php 
use App\Http\Controllers\frontend\GuidesController; 
use App\User; 
use Illuminate\Support\Facades\Storage;
?>
 <form action="{{ route('guides.index') }}" id="sky-form4" class="sky-form" class="smart-form" method="GET"  >
<div class="row" style="border:1px dashed green;margin-bottom:5px;background:#ffe699">       
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
                        <input type="text" value="{{$searchField->fullname_en}}" name="fullname_en" placeholder="{{$layout->label->fullname_en->title }}">
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
                                   @if($searchField->gender==$gender->term_id)
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
                                 @if($searchField->guide_type_id==$guide_type->term_id)
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
                            @if($errors->has('nationality_id'))
                                <div class="error-badge" id="for-nationality_id">                                                            
                                    {!! Helper::alert('danger', $errors->first('nationality_id')) !!}
                                </div>
                            @endif
                </label>
                <label class="select">
                     <select value="{{ old('nationality_id') }}" name="nationality_id" >
                         <option value="0" selected >{{$layout->label->please_select_below->title}}</option>
                            @foreach($nationalities as $nationality)
                                 @if($searchField->nationality_id==$nationality->term_id)
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
                                 @if($searchField->guide_language==$guide_language->term_id)
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
                                  
                                            
</div>


<?php

/*
if(sizeof($users)==0){
    echo "<h2 class='text text-center text-danger' style='padding:100px;font-size:66px'>NO DATA FOUND!!!</h2>";
}

foreach ($users as $key=>$value) {
    $uid=$value->id;
  $url='/guides/'.Helper::encodeString($value->id,Helper::encryptKey());
  $uemail=$value->email;  

$user_meta=Helper::metas('user_meta',['user_id' => $uid] );
$guide_prices=$value->guide_price;

$gp_language="";
$gp_province="";
$gp_price="";
//$gp is guide price
foreach ($guide_prices as $key => $value) {    
   if($value->default=='yes'){
        $gp_language=($value->default=='yes')?$value->language->title:"";
        $gp_province=($value->default=='yes')?$value->province->title:"";   
        $gp_price=($value->default=='yes')?$value->price:""; 
   }
}

$photo_path='';
$file=Storage::url($uid.'/'. $user_meta->photo->value);
if(!file_exists($file)){
    $photo_path=Storage::url($uid.'/'. $user_meta->photo->value);
}


$date1=new DateTime($user_meta->dob->value);
$date_2 = new DateTime( date( 'Y-m-d' ) );
$difference = $date_2->diff( $date1);
$age= $difference->y;
$profileID=Helper::encodeString($uid,Helper::encryptKey());
// $profileID=$uid;*/

 
/*echo '
  <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <a href="/guides/detail/'.$profileID.'">
                        <img src="'. $photo_path .'" alt="Guide"
                            class="img-rounded img-responsive guideprofile" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6 section-box">
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
                            '.$layout->label->location->title.': '.$gp_province.' | '.$layout->label->language->title.': '.$gp_language.'  
                        </p>
                        <p>
                            '.$layout->label->number_of_booking->title.': <b>34</b> BOOKINGS
                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price"><b>'.$gp_price.'</b> '.$layout->label->usd->title.'</h3>
                        <em class="perday">'.$layout->label->per_day->title.'</em>
                       
                    </div>
                    <div class="col-xs-12 col-md-2 text-center">
                         <img src="data:image/png;base64,'.base64_encode(QrCode::format("png")->size(140)->generate($url)).' ">
                    </div>
                </div>
            </div>
    </div>
    ';*/





?>


@if(count($users)==0)   
                <tr>
                    <td colspan="7">
                        NO DATA FOUND
                    </td>
                </tr>
            @endif
                @foreach($users as $user)
                @php 
                    $uid=$user["id"];
                    $fullnameEN='' ;
                    $gender='' ;
                    $guide_type='';
                    $nationality='';
                    $photo='';
                    $dob='';
                @endphp
                    @foreach($user["user_metas"] as $um)

                       @php
                        switch($um["meta_key"]){
                            case 'fullname_en' : $fullname_en = $um["meta_value"];break;
                            case 'fullname_kh' : $fullname_kh = $um["meta_value"];break;
                            case 'license_id' : $license_id = $um["meta_value"];break;
                            case 'address' : $address = $um["meta_value"];break;
                            case 'dob' : $dob = $um["meta_value"];break;
                            case 'gender' : $gender = $um["meta_value"];break;
                            case 'telephone' : $telephone = $um["meta_value"];break;
                            case 'nationality_id' : $nationality_id = $um["meta_value"];break;
                    
                            case 'generation' : $generation = $um["meta_value"];break;
                            case 'guide_certified' : $guide_certified = $um["meta_value"];break;
                            case 'behavior_certified' : $behavior_certified = $um["meta_value"];break;
                            case 'id_card' : $id_card = $um["meta_value"];break;
                            case 'partner_id' : $partner_id = $um["meta_value"];break;
                            case 'cv_provided' : $cv_provided = $um["meta_value"];break;
                            case 'guide_type_id' : $guide_type_id = $um["meta_value"];break;
                            case 'domicile_certified' : $domicile_certified = $um["meta_value"];break;
                            case 'new_renew' : $new_renew = $um["meta_value"];break;
                            case 'issued_date' : $issued_date = $um["meta_value"];break;
                            case 'expired_date' : $expired_date = $um["meta_value"];break;
                            case 'date_in_service' : $date_in_service = $um["meta_value"];break;
                            case 'photo' : $photo = $um["meta_value"];break;
                        }
                        $photo_path='';
                        if($photo!==''){
                           $file=Storage::url($uid.'/'. $photo);
                            if(!file_exists($file)){
                                $photo_path=Storage::url($uid.'/'. $photo);
                            }
                        }else{
                          $photo_path ='https://www.greatplacetowork.com/templates/gptw/images/no-image-available.jpg';
                        }
                       
                        $url='/guides/'.Helper::encodeString($uid,Helper::encryptKey());
                        $profileID=Helper::encodeString($uid,Helper::encryptKey());
                        $date1=new DateTime($dob);
                        $date_2 = new DateTime( date( 'Y-m-d' ) );
                        $difference = $date_2->diff( $date1);
                        $age= $difference->y;
                       @endphp
                    @endforeach
                    @php
                    $guide_prices=$user["guide_price"];
                    $gp_language="";
                    $gp_province="";
                    $gp_price="";
                    //$gp is guide price
                    foreach ($guide_prices as $gp) {    
                       if($gp["default"]=='yes'){
                            $gp_language=($gp["default"]=='yes')?$gp["language_id"]:"";
                            $gp_province=($gp["default"]=='yes')?$gp["province_id"]:"";   
                            $gp_price=($gp["default"]=='yes')?$gp["price"]:""; 
                       }
                    }
                    @endphp

                    <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row blockguide" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <a href="/guides/detail/{{$profileID}}">
                        <img src="{{$photo_path}}" alt="Guide"
                            class="img-thumbnail<img img-responsive guideprofile" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-6 section-box">
                        <h2 class="text text-info">
                             <a href="/guides/detail/{{$profileID}}">{{$fullname_en}}</a>
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <span class="glyphicon glyphicon-comment"></span>(100 Comments)
                                </span>                               
                        </h2>
                        <p>
                            {{$layout->label->nationality->title}}: {{Helper::term_translate($nationality_id)}}
                            | {{$layout->label->date_of_birth->title}}:{{$dob}} &nbsp; | {{$layout->label->guide_age->title}} : {{$age}} {{$layout->label->year->title}}
                            | {{$layout->label->gender->title}}: {{Helper::term_translate($gender)}} <br>
                            | {{$layout->label->guide_type->title}}: {{Helper::term_translate($guide_type_id)}} 
                        </p>
                         <p>
                            {{$layout->label->location->title}}: {{Helper::term_translate($gp_province)}} | {{$layout->label->language->title}}: {{Helper::term_translate($gp_language)}} 
                        </p>
                        <p>
                            {{$layout->label->number_of_booking->title}}: <b>{{Helper::countBooking($uid)}}</b> {{$layout->label->number_booking->title}}
                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price"><b>{{$gp_price}} </b> {{$layout->label->usd->title}}</h3>
                        <em class="perday">{{$layout->label->per_day->title}}</em>
                       
                    </div>
                    <div class="col-xs-12 col-md-2 text-center">
                         <img src="data:image/png;base64,{{base64_encode(QrCode::format('png')->size(140)->generate($url))}} ">
                    </div>
                </div>
            </div>
            </div>
                @endforeach



<div class="col-lg-12" >

            <div class="col-lg-2">
                   <h5>Total Records:<b> {{$totalRecords}}</b></h5>
            </div>
            <div class="col-lg-3">
                {!! $users->appends(Input::except('page'))->links() !!}
            </div>
    
        </div>


 </form>  