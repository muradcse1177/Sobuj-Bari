@extends('website.layout')
@section('title', 'About')
@section('abb', 'current')
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
    <section class="success-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Image Column-->
                <div class="image-column col-md-5 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="image">
                            <img src="{{url('public/images/resource/success-1.jpg')}}" alt="" />
                        </div>
                        <div class="small-img">
                            <img src="{{url('public/images/resource/success-2.jpg')}}" alt="" />
                        </div>
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-md-7 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="since-year clearfix">
                            <span class="title">since</span>
                            <div class="year-img" style="font-size: 50px; color: black;"><b>2015</b></div>
                            @php
                                $date1 = "2015-01-01";
                                $date2 = date('Y-m-d');
                                $diff = abs(strtotime($date2) - strtotime($date1));

                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            @endphp
                            <div class="work">{{$years.' '}} Years OF<strong>Success</strong><span>Work</span></div>
                        </div>
                        <div class="text text-justify">Apparently we had reached a great height in the atmosphere for the sky was a dead black and the stars headcase to twinkle. We providing international construction services company and is a leading builder in diverse market segments. The company earned recognition for undertaking large, complex projects, fostering innovation, embracing emerging technologies and making a difference.</div>

                        <div class="fact-">
                            <div class="row clearfix">

                                <!--Column-->
                                <div class="column -column col-md-3 col-sm-6 col-xs-12">
                                    <div class="inner">
                                        <div class="-outer -box">
                                            <span class="-text" style="font-size: 40px; color: black;" data-speed="3500" data-stop="200">85</span>
                                            <h4 class="-title">Projects</h4>
                                        </div>
                                    </div>
                                </div>

                                <!--Column-->
                                <div class="column -column col-md-3 col-sm-6 col-xs-12">
                                    <div class="inner">
                                        <div class="-outer -box">
                                            <span class="-text" style="font-size: 40px; color: black;" data-speed="2500" data-stop="895">35</span>
                                            <h4 class="-title">Employers</h4>
                                        </div>
                                    </div>
                                </div>

                                <!--Column-->
                                <div class="column -column col-md-3 col-sm-6 col-xs-12">
                                    <div class="inner">
                                        <div class="-outer -box">
                                            <span class="-text" style="font-size: 40px; color: black;" data-speed="2200" data-stop="954">251</span>
                                            <h4 class="-title">Customers</h4>
                                        </div>
                                    </div>
                                </div>

                                <!--Column-->
                                <div class="column -column col-md-3 col-sm-6 col-xs-12">
                                    <div class="inner">
                                        <div class="-outer -box">
                                            <span class="-text" style="font-size: 40px; color: black;" data-speed="2000" data-stop="25">03</span>
                                            <h4 class="-title">Awards</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="fluid-section-one">
        <div class="outer-container clearfix">
            <!--Image Column-->
            <div class="image-column" style="background-image:url(public/images/resource/image-1.jpg);">
                <figure class="image-box"><img src="{{url('public/images/resource/image-1.jpg')}}" alt=""></figure>
            </div>
            <!--Content Column-->
            <div class="content-column">
                <div class="inner-box">
                    <div class="sec-title">
                        <div class="title">Our Working Area</div>
                        <h2><span class="theme_color">About </span> Us</h2>
                    </div>
                    <div class="text text-justify">{!!  nl2br($infos->about) !!}</div>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section-two" style="background-image:url(/images/background/4.jpg)">
        <div class="auto-container">
            <div class="sec-title centered">
                <div class="title">Services We Offer & Solutions</div>
                <h2><span class="theme_color">Our</span> Main Services</h2>
            </div>
            <div class="row clearfix">
                @foreach($services as $service)
                    <div class="services-block-two col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="icon-box">
                                    <span class="icon flaticon-brick-wall"></span>
                                </div>
                                <h3><a href="{{url('service?cat='.$service->id)}}">{{$service->title}}</a></h3>
                            </div>
                            <div class="text text-justify">{{substr($service->description,0,120).'...'}}</div>
                            <a href="{{url('service?cat='.$service->id)}}" class="read-more">Read More <span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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
