@extends('website.layout')
@section('title', 'Home')
@section('ap', 'current')
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
    <section class="project-section">
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
                {{$projects->links()}}
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
