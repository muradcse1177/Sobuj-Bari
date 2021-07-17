@extends('website.layout')
@section('title', 'Project-Details')
@section('cu', 'current')
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
    <section class="map-section">
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
    </section>
    <section class="contact-section">
        <div class="auto-container">

            <h2><span class="theme_color">Get</span> in Touch</h2>
            <div class="text">You can talk to our online representative at any time. Please use our Live Chat System on our website or Fill up below instant messaging programs. <br> Please be patient, We will get back to you. Our 24/7 Support, General Inquiries Phone: +8801707011562</div>
            <div class="row clearfix">
                <div class="form-column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="contact-form style-two">
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
                <div class="info-column col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    <ul class="list-style-two">
                        <li><span class="icon flaticon-home-1"></span><strong>Address</strong>{{$rows->address}}</li>
                        <li><span class="icon flaticon-envelope-1"></span><strong>Send your mail at</strong>{{$rows->email}}</li>
                        <li><span class="icon flaticon-technology-2"></span><strong>Have Any Question</strong>{{$rows->phone}}</li>
                        <li><span class="icon flaticon-clock-1"></span><strong>Working Hours</strong>{{$rows->hours}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>

    </script>
@endsection
