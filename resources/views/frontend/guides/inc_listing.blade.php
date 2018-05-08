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
                            <select name="gender" >
                                    <option value="{{ old('gender') }}" value="" selected >Select Gender</option>
                                        @if(old('gender')=='m')
                                         <option selected value="m">Male</option>
                                         <option value="f">Female</option>
                                        @elseif(old('gender')=='f')
                                          <option value="m">Male</option>
                                          <option selected value="f">Female</option>
                                        @else
                                          <option value="m">Male</option>
                                          <option  value="f">Female</option>
                                        @endif                                                    
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
                         <option value="0" selected >Select Below</option>
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
                         <option value="" selected >Select Below</option>
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
                         <option value="0" selected >Select Below</option>
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


<div class="table-footer">
    {!! \Helper::paginator_fr(['route' => 'layout_items'], ['items' => $layout_items], ['display' => $display]) !!}
</div>

<?php for($i=1;$i<=10;$i++){?>
 <div class="row" >
            <div class="well well-sm" style="margin-bottom:10px">
                <div class="row" >
                    <div class="col-xs-12 col-md-2 text-center">
                        <img src="https://4.bp.blogspot.com/--_laOkwN518/WpZz6ihj_TI/AAAAAAAAFa8/PjkP1DlrYY8CumcmG1OJzEA0jGiz21aBwCLcBGAs/s1600/26238792_2024008117887535_2499545972778675283_n.jpg" alt="Guide"
                            class="img-rounded img-responsive guideprofile" />
                    </div>
                    <div class="col-xs-12 col-md-8 section-box">
                        <h2 class="text text-info">
                            Vom Vannoch 
                                <span style="font-size:14px">
                                    <span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty">
                                    </span><span class="glyphicon glyphicon-star-empty"></span><span class="separator">|</span>
                                    <span class="glyphicon glyphicon-comment"></span>(100 Comments)
                                </span>                               
                        </h2>
                        <p>
                            KHMER | 42 Years old | Male | Service Location: Siem Reap   
                        </p>
                         <p>
                            Guide Type: National | Language: English  
                        </p>
                        <p>
                            Number of Booking: <b>34</b> BOOKINGS
                        </p>
                       
                       
                    </div>
                     <div class="col-xs-12 col-md-2 text-center">
                        <h3 class="price">50 USD</h3>
                        <em class="perday">Per day</em>
                    </div>
                </div>
            </div>
</div>
<?php } ?>


<div class="table-footer">
    {!! \Helper::paginator_fr(['route' => 'layout_items'], ['items' => $layout_items], ['display' => $display]) !!}
</div>


                                    