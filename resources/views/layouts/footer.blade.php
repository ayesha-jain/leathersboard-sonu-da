<!-- ##### Newsletter Area Start ##### -->

<section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('email_subscription_form_submit') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="email" name="subscriberemail" class="email" placeholder="Your E-mail" required>
                            @if ($errors->has('subscriberemail'))
                                <span style="color: #fff">
                                The email field is required.
                                </span>
                            @endif

                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.html"><img src="{{ asset('assets/img/core-img/logo2.png') }}" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                        @php
                        $category = App\Models\Category::where('status','1')->first();
                        @endphp
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item {{ in_array(Route::currentRouteName(), ['homepage']) ? ' active': '' }}">
                                            <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                                        </li>
                                        <li class="nav-item {{ in_array(Route::currentRouteName(), ['category_page']) ? ' active': '' }}">
                                            <a class="nav-link" href="{{ route('category_page',$category->id) }}">Category</a>
                                        </li>
                                        <!-- <li class="nav-item {{ in_array(Route::currentRouteName(), ['product_page']) ? ' active': '' }}">
                                            <a class="nav-link" href="{{ route('product_page') }}">Product</a>
                                        </li> -->
                                        <li class="nav-item {{ in_array(Route::currentRouteName(), ['about_us']) ? ' active': '' }}">
                                            <a class="nav-link" href="{{ route('about_us') }}">About Us</a>
                                        </li>
                                        <li class="nav-item {{ in_array(Route::currentRouteName(), ['contact_us']) ? ' active': '' }}">
                                            <a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->