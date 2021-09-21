@extends('website.layout')
@section('title', 'Home || Sobuj Bari')
@section('hhh', 'current')
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
    <section class="success-section" style="background-image:url(public/images/background/4.jpg)">
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
    <section class="services-section">
        <div class="auto-container">
            <div class="sec-title">
                <div class="title">We Build Your Hope</div>
                <h2><span class="theme_color">Our</span> Services</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme">
                @foreach($services as $service)
                <div class="services-block">
                    <div class="inner-box">
                        <div class="image">
                            <a href="{{url('service?cat='.$service->id)}}"><img src="{{'public/images/'.$service->image}}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="upper-box">
                                <div class="icon-box">
                                    <span class="icon flaticon-drawing"></span>
                                </div>
                                <h3><a href="{{url('service?cat='.$service->id)}}">{{$service->title}}</a></h3>
                            </div>
                            <div class="text text-justify" style="color: black;">{{substr($service->description,0,150)}}<a href="{{url('service?cat='.$service->id)}}"><b>{{' More...'}}</b></a></div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                        <div class="title">We Offer Best Services & Solutions</div>
                        <h2><span class="theme_color">Why </span> Choose Us</h2>
                    </div>
                    <div class="text text-justify">{!!  nl2br($infos->choose) !!}</div>
                    <ul class="list-style-one clearfix">
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-briefcase-1"></span>EXPERT & PROFESSIONAL</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-diamond-1"></span>PROFESSIONAL APPROACH</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-bank-building"></span>HIGH QUALITY WORK</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-two-fingers-up"></span>SATISFACTION GUARANTEE</li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-brickwall"></span>PREVIOUS EXPERIENCE </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-user"></span>STRONG TEAM </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-timer"></span>TIMELY HANDOVER </li>
                        <li class="col-md-6 col-sm-6 col-xs-12"><span class="icon flaticon-time"></span>24/7 SERVICE </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section-two" style="background-image:url(public/images/background/4.jpg)">
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
    <section class="project-section" style="background-color:url(/images/background/1.jpg);">
        <div class="auto-container">
            <div class="sec-title centered">
                <div class="title">Our Best Works</div>
                <h2><span class="theme_color">Our</span> Recent Projects</h2>
            </div>

            <!--MixitUp Galery-->
            <div class="mixitup-gallery">

                <!--Filter-->
                <div class="filters clearfix">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="active filter" data-role="button" data-filter="all">Show All</li>
                        @foreach($types as $type)
                            <li class="filter" data-role="button" data-filter="{{'.'.$type->type}}">{{$type->type}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-list row clearfix">
                    @foreach($projects as $project)
                    <div class="gallery-item mix all {{$project->type}} col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{'public/images/'.$project->cover_phote}}" alt="">
                                <!--Overlay Box-->
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <ul>
                                            <li><a href="{{url('project-details?id='.$project->id)}}" class="image-link"><span class="icon fa fa-link"></span></a></li>
                                            <li><a href="{{'public/images/'.$project->cover_phote}}" data-fancybox="images" data-caption="" class="link"><span class="icon flaticon-picture-gallery"></span></a></li>
                                        </ul>
                                        <div class="content">
                                            <h3><a href="{{url('project-details?id='.$project->id)}}">{{$project->name}}</a></h3>
                                            <div class="category">{{$project->type}}</div>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    <!--End Project Section-->

    <!--Call To Action-->
    <section class="call-to-action-section" style="background-image:url(public/images/background/2.jpg)">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-md-9 col-sm-12 col-xs-12">
                    <div class="text">We provide experience & <span class="theme_color">high level construction</span> work solution for you!!</div>
                </div>
                <!--Btn Column-->
                <div class="btn-column col-md-3 col-sm-12 col-xs-12">
                    <a href="{{url('contact')}}" class="theme-btn btn-style-three">Start A Project</a>
                </div>
            </div>
        </div>
    </section>
    <!--End Call To Action-->

    <!--Featured Section-->
    <section class="featured-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-md-6 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <div class="title">Checkout Our Video For</div>
                            <h2><span class="theme_color">Featured</span> Work</h2>
                        </div>
                        <div class="text text-justify">
                            <p>Our main focus to help your business growth and your business marketing strategy for profitable scale. We are following below issues</p>
                            <p>We partner with over 251 amazing seeds projects worldwide, & have given over million in cash & product grants to other groups since 2015 our own dynamic suite. There anyone who loves or pursues or desires to obtain pain of it is because seeds all occasionally circumstances.</p>
                        </div>
                        <a href="{{url('contact')}}" class="theme-btn btn-style-four">Contact Us</a>
                    </div>
                </div>

                <!--Video Column-->
                <div class="video-column col-md-6 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="video-box">
                            <figure class="image">
                                <img src="{{url('public/images/resource/video-img.jpg')}}" alt="">
                                <a href="https://www.youtube.com/watch?v=KsrbdSwaVvA&t=62s" class="lightbox-image overlay-box"><span class="flaticon-arrow"></span></a>
                            </figure>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="clients-section">
        <div class="auto-container">
            <div class="sec-title centered">
                <h2><span class="theme_color">Our</span> Valuable Clients</h2>
            </div>
            <div class="sponsors-outer">
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @foreach($clients as $client)
                        <li class="slide-item"><figure class="image-box"><a href="#"><img src="{{url('public/images/'.$client->photo)}}" height="150" width="150" alt=""></a></figure></li>
                    @endforeach
                </ul>
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
        <div class="auto-container" style="background-image:url(public/images/background/1.jpg)">
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
