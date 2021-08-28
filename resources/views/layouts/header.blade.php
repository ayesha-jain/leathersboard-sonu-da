<!-- Header Area Start -->
<header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('homepage') }}"><img src="{{ asset('assets/img/core-img/logo.png') }}" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    @php
                    $category = App\Models\Category::where('status','1')->first();
                    @endphp
                    <li class="{{ in_array(Route::currentRouteName(), ['homepage']) ? ' active': '' }}"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="{{ in_array(Route::currentRouteName(), ['category_page','product_page']) ? ' active': '' }}"><a href="{{ route('category_page',$category->id) }}">Category</a></li>
                    <!-- <li class="{{ in_array(Route::currentRouteName(), ['product_page']) ? ' active': '' }}"><a href="{{ route('product_page') }}">Product</a></li> -->
                    <li class="{{ in_array(Route::currentRouteName(), ['about_us']) ? ' active': '' }}"><a href="{{ route('about_us') }}">About Us</a></li>
                    <li class="{{ in_array(Route::currentRouteName(), ['contact_us']) ? ' active': '' }}"><a href="{{ route('contact_us') }}">Contact Us</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <!-- <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a> -->
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <!-- <a href="cart.html" class="cart-nav"><img src="{{ asset('assets/img/core-img/cart.png') }}" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="{{ asset('assets/img/core-img/favorites.png') }}" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="{{ asset('assets/img/core-img/search.png') }}" alt=""> Search</a> -->
            </div> 
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->