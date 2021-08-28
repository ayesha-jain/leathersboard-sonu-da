@extends('layouts.app')

@section('pageTitle','Welcome to abstract management')

@section('customStyle')
<link rel="stylesheet" type="text/css" href="{{ asset('assets_contact/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets_contact/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets_contact/css/templatemo-klassy-cafe.css') }}">
<link rel="stylesheet" href="{{ asset('assets_contact/css/owl-carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets_contact/css/lightbox.css') }}">
@endsection

@section('content')

<div class="single-product-area section-padding-100 clearfix">
<section class="section" id="reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>Contact Us</h6>
                            <h2>Contact Us Quickly!</h2>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <h4>Phone Numbers</h4>
                                    <span>Sayari Saha<br><b> +91 9831980304</b></span><br><br>
                                    <span>Avishek Bhardwaj<br><b>+91 9830007564</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="message">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Emails</h4>
                                    <span>sayari@leathers.work</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('contact_us_form_submit') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Let Us Contact You!</h4>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {!! session('success') !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" id="name" placeholder="Your Name*" required>
                                    </fieldset>
                                    @if ($errors->has('name'))
                                        <span style="color: #f01f31;">
                                        {{ $errors->first('name') }}
                                        </span>
                                    @endif

                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address*" required>
                                    </fieldset>
                                    @if ($errors->has('email'))
                                        <span style="color: #f01f31;">
                                        {{ $errors->first('email') }}
                                        </span>
                                    @endif

                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" id="message" placeholder="Message*" required ></textarea>
                                    </fieldset>
                                    @if ($errors->has('message'))
                                        <span style="color: #f01f31;">
                                        {{ $errors->first('message') }}
                                        </span>
                                    @endif
                                    <br><br>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button-icon">Submit</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>        
</div>
</div>
</div>
@endsection

@section('customScript')

<script src="{{ asset('assets_contact/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets_contact/js/popper.js') }}"></script>
<script src="{{ asset('assets_contact/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets_contact/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets_contact/js/accordions.js') }}"></script>
<script src="{{ asset('assets_contact/js/datepicker.js') }}"></script>
<script src="{{ asset('assets_contact/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets_contact/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets_contact/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets_contact/js/imgfix.min.js') }}"></script>
<script src="{{ asset('assets_contact/js/slick.js') }}"></script>
<script src="{{ asset('assets_contact/js/lightbox.js') }}"></script>
<script src="{{ asset('assets_contact/js/isotope.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('assets_contact/js/custom.js') }}"></script>

@endsection