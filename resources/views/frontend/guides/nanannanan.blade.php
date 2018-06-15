<?php
$user=$users[0];
/*foreach ($users as $key=>$value) {
  $uid=$value->id;
  $user_meta=Helper::metas('user_meta',['user_id' => $uid] );
  $guide_prices=$value->guide_price;

}*/
$uid=$user->user_metas[0]->user_id;
$user_meta=Helper::metas('user_meta',['user_id' => $uid] );
$guide_prices=$user->guide_price;
$photo_path="http://www.nurnberg.com/images/image_unavailable_lrg.png";
if(($user_meta->photo->value)!=="")
$photo_path=Storage::url('guide_profile_test/' . $user_meta->photo->value);
$url='/guides/'.Helper::encodeString($user->id,Helper::encryptKey());
//$gp is guide price
$gp_language="";
$gp_province="";
$gp_price="";

foreach ($guide_prices as $key => $value) {
    $gp_language=($value->default=='yes')?$value->language->title:"";
    $gp_province=($value->default=='yes')?$value->province->title:"";   
    $gp_price=($value->default=='yes')?$value->price:""; 
}
?>
<h1 class="text text-primary text-center">Guide Profile Information</h1>
<div class="row">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <img src="{{$photo_path}}" alt="" class="img-rounded img-responsive" />
                        <br/>
                        	<h4 class="text text-center">ID: <b>{{$user->id}}</b></h4>
                        <table class="table table-responsive tabledetail" >                          	
                       		<tr>
                       			<td class="first_td">{{$layout->label->issued_date->title}}:</td>
                       			<td> <b>{{$user_meta->issued_date->value}}</b></td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->expired_date->title}}:</td>
                       			<td><b>{{$user_meta->expired_date->value}}</b></td>
                       		</tr>                       		
                       </table>
                       <img src="data:image/png;base64,<?php echo base64_encode(QrCode::format('png')->size(200)->generate($url)); ?> ">
                    </div>
                    <div class="col-sm-6 col-md-9">
                        <h4>
                            <b>{{$user_meta->fullname_en->value}}</b>
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <span class="glyphicon glyphicon-comment"></span>(100 Comments)
                                </span>       
                         </h4>
                        
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>{{$layout->label->email->title}}: <a href="#">{{$user->email}}</a>
                            <br />
                            <i class="glyphicon glyphicon-phone"></i>{{$layout->label->telephone->title}}: <a href="#">{{$user_meta->telephone->value}}</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>{{$layout->label->date_of_birth->title}}: {{$user_meta->dob->value}}
                            <br/>                            
                        </p>
                       <table class="table table-responsive tabledetail" >
                       		<tr class="underreview">
                       			<td class="first_td " >Number of Bookings:</td>
                       			<td> <b>4</b>bookings</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->gender->title}}:</td>
                       			<td> {{$user_meta->gender->title}}</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->nationality->title}}:</td>
                       			<td> {{$user_meta->nationality_id->title}}</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->guide_type->title}}:</td>
                       			<td> {{$user_meta->guide_type_id->title}}</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->language->title}}:</td>
                       			<td>  {{$gp_language}}</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->province->title}}:</td>
                       			<td>  {{$gp_province}}</td>
                       		</tr>
                       		<tr>
                       			<td class="first_td">{{$layout->label->license_id->title}}:</td>
                       			<td>  {{$user_meta->license_id->value}}</td>
                       		</tr>
                       </table>
                       
                    </div>
                </div>
                <div class="row ">
                	<h2 class="text text-center">Price according to Location & Languages</h2>
                	<div class="col-lg-12">
                		<h4 class="text text-center text-primary">Price Depend on Languages</h4>
                		<table class="table table-responsive tabledetail" >   
                    <tr>
                      <th>Language</th>
                      <th>Province</th>
                      <th>Price</th>
                      <th>Default</th>
                    </tr>
                    @php 
                    foreach ($guide_prices as $key => $value) {
                      echo '
                           <tr>
                            <td class="first_td">'.$value->language->title.'</td>
                            <td class="first_td">'.$value->province->title.'</td>
                            <td> <b>'.$value->price.' USD/day</b></td>
                            <td class="">'.$value->default.'</td>
                          </tr>
                      ';
                        
                    } 
                    @endphp                     	
                       		
                       </table>
                	</div>                	
                </div><!--end class row-->
                <div class="table-responsive">

                <table class="table table-hover">
                  <thead>
                    <tr class="bg bg-primary">
                      <th>ID</th>
                      <th>{{$layout->label->guide_id->title}}</th>
                      <th>{{$layout->label->language->title}}</th>
                      <th>{{$layout->label->location->title}}</th>
                      <th>{{$layout->label->guide_price->title}}</th>
                      <th>{{$layout->label->default->title}}</th>
                      <th>{{$layout->label->fee_additional->title}}</th>
                                       
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($guideprices) ==0)
                      {!! Helper::empty_table(10) !!}
                    @endif

                    @foreach($guideprices as $key => $guideprice)
                      <?php $user_meta=Helper::metas('user_meta',['user_id' => $guideprice->guide_id] );?>
                          <tr>
                            <td>{{ \Helper::indexed($guideprices, $key) }}</td>
                            <td>
                              <code>
                                {{ $guideprice->guide_id }}
                              </code>
                              <a id="{{ $guideprice->id }}" class="hyper"></a>
                              <br>
                              {{$user_meta->fullname_en->value}}
                              
                           
                            </td>
                            <td>
                              <a href="{{ $guideprice->content_parent }}">
                                {{ $guideprice->language->title }}
                              </a>
                            </td>
                            <td>
                              <a href="#p{{ $guideprice->translate_of }}">
                                <span class="font-12 txt-color-blue">
                                  {{ $guideprice->province->title }}
                                </span>
                              </a>
                            </td>
                            <td>
                              <code>
                                {{ $guideprice->price }} <code>USD</code>
                              </code>
                            </td>
                            <td>
                              <div class="truncate-35" title="{{ $guideprice->title }}">
                                {!! $guideprice->default !!}
                              </div>
                            </td>
                            <td>  
                              <div class="truncate-275" title="{{ $guideprice->title }}">                           
                              @php
                                $details=$guideprice->guideprice_detail;
                              @endphp
                              <table  class="table table-responsive table-hover" 
                              style="background-color:#f0f0f5;font-size:12px">
                                @php
                                  $n=1;
                                @endphp
                                @foreach($details as $detail)
                                <tr>
                                  <td>{{$n++}}</td>
                                  <td>{{$detail->fee->title}}</td>
                                  <td>{{$detail->gp_price}}<code>USD</code></td>
                                  
                                </tr>
                                @endforeach

                            
                              </table>
                              </div>
                            </td>
                          
                           
                          </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!--end class well-->
</div>