@extends('website.layout')
@section('title', 'Project-Details')
@section('as', 'current')
@section('content')

    @php
        use Illuminate\Support\Facades\DB;
            $rows = DB::table('company_info')->first();
            $services = DB::table('services')->get();
    @endphp
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    @foreach($slides as $slide)
                        <li>
                            <img src="{{url('public/images/'.$slide->slide)}}">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="contact-number"><span class="icon flaticon-phone-call"></span>Call Us: {{$rows->phone}}</div>
    </section>

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <aside class="sidebar default-sidebar">

                        <div class="sidebar-widget sidebar-blog-category">
                            <ul class="blog-cat">
                                @foreach($services  as $serve)
                                <li class ="@if($_GET['cat'] == $serve->id) {{'active'}} @endif"><a href="{{'service?cat='.$serve->id}}">{{$serve->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="solution-box" style="background-image:url(public/images/resource/image-2.jpg)">
                            <div class="inner">
                                <div class="title">Quick Contact</div>
                                <h2>Get Solution</h2>
                                <div class="text">Contact us at the Construction office nearest to you or submit a business inquiry online.</div>
                                <a class="solution-btn theme-btn" href="{{url('contact')}}">Contact Us</a>
                            </div>
                        </div>

                    </aside>
                </div>

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="services-single">
                        <div class="inner-box">

                            <!--Services Gallery-->
                            <div class="services-gallery">
                                <div class="row clearfix">
                                    <div class="column col-md-8 col-sm-8 col-xs-12">
                                        <div class="image">
                                            <img src="{{url('public/images/resource/services-4.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                    <div class="column col-md-4 col-sm-4 col-xs-12">
                                        <div class="image">
                                            <img src="{{url('public/images/resource/services-5.jpg')}}" alt="" />
                                        </div>
                                        <div class="image">
                                            <img src="{{url('public/images/resource/services-6.jpg')}}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2>{{$service->title}}</h2>
                            <div class="text text-justify">
                                {!! nl2br($service->description) !!}
                            </div><br><br>
                            <h3 class="alternate"><span class="theme_color">Working</span> Process</h3>
                            <!--Process Boxed-->
                            <div class="process-boxed">
                                <div class="row clearfix">

                                    <!--Process Block-->
                                    <div class="process-block col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="upper-box">
                                                <div class="icon-box">
                                                    <span class="icon flaticon-search"></span>
                                                    <div class="block-number">1</div>
                                                </div>
                                            </div>
                                            <div class="lower-box">
                                                <h4><a href="#">DISCOVER</a></h4>
                                                <div class="text text-justify">People with ideas and experience to develop a vision for the future.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Process Block-->
                                    <div class="process-block col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="upper-box">
                                                <div class="icon-box">
                                                    <span class="icon flaticon-settings-1"></span>
                                                    <div class="block-number">2</div>
                                                </div>
                                            </div>
                                            <div class="lower-box">
                                                <h4><a href="#">BUILD</a></h4>
                                                <div class="text text-justify">The right tools at the right time enhances the shard economy.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Process Block-->
                                    <div class="process-block col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="upper-box">
                                                <div class="icon-box">
                                                    <span class="icon flaticon-telemarketer"></span>
                                                    <div class="block-number">3</div>
                                                </div>
                                            </div>
                                            <div class="lower-box">
                                                <h4><a href="#">LAUNCH</a></h4>
                                                <div class="text text-justify">Bringing highly anticipated programs to the marketplace.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="call-to-action-section-two" style="background-image:url(public/images/background/7.jpg)">
        <div class="auto-container">
            <div class="row clearfix">

                <div class="column col-md-7 col-sm-12 col-xs-12">
                    <h2><span class="theme_color">Construction</span> Company</h2>
                    <div class="text">If you have any construction & renovation work need, simply call our 24 hour emergency number.</div>
                </div>
                <div class="btn-column col-md-5 col-sm-12 col-xs-12">
                    <div class="number">+8801707011562 <span class="theme_color"> or </span> <a href="{{url('contact')}}" class="theme-btn btn-style-five">Contact Us</a> </div>
                </div>

            </div>
        </div>
    </section>
    <section class="contact-info-section">
        <!--Map Section-->
        <div class="map-section">
            <!--Map Outer-->
            <div class="map-outer">
                <!--Map Canvas-->
                <iframe
				  width="100%"
				  height="600"
				  style="border:0"
				  loading="lazy"
				  allowfullscreen
				  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAOc0-5SE59M8qVpKbDKPPt7bda9xiOEaE
					&q=Sobuj Bari">
				</iframe>
            </div>
        </div>
        <!--Map Section-->
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <!--Info Column-->
                    <div class="info-column col-md-4 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <ul class="list-style-two">
                                <li><span class="icon flaticon-home-1"></span><strong>Address</strong>{{$rows->address}}</li>
                                <li><span class="icon flaticon-envelope-1"></span><strong>Send your mail at</strong>{{$rows->email}}</li>
                                <li><span class="icon flaticon-technology-2"></span><strong>Have Any Question</strong>{{$rows->phone}}</li>
                                <li><span class="icon flaticon-clock-1"></span><strong>Working Hours</strong>{{$rows->hours}}</li>
                            </ul>
                        </div>
                    </div>
                    <!--Form Column-->
                    <div class="form-column col-md-8 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <h2>Contact Us</h2>
                            <!--Contact Form-->
                            <div class="contact-form">
                                {{ Form::open(array('url' => 'send-mail',  'method' => 'post')) }}
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                    <div class="row clearfix">
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="name" value="" placeholder="Name" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="email" name="email" value="" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="subject" value="" placeholder="Subject" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                            <input type="text" name="phone" value="" placeholder="Phone" required>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <textarea name="message" placeholder="Your Massage"></textarea>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                            <button type="submit" class="theme-btn btn-style-one">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                            @if ($message = Session::get('successMessage'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Thank You!!</h4>
                                    {{ $message }}</b>
                                </div>
                            @endif
                            @if ($message = Session::get('errorMessage'))

                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Sorry!</h4>
                                    {{ $message }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>

    </script>
@endsection
