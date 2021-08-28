@extends('layouts.app')

@section('pageTitle','Welcome to abstract management')

@section('customStyle')
@endsection

@section('content')
<div class="shop_sidebar_area">

<!-- ##### Single Widget ##### -->
<div class="widget catagory mb-50">
    <!-- Widget Title -->
    <h6 class="widget-title mb-30">Categories</h6>

    <!--  Catagories  -->
    <div class="catagories-menu">
        <ul>
        @if(isset($categories) && count($categories)>0)
            @foreach($categories as $category)
                <li @if($categoryid==$category->id) class="active" @endif><a href="{{ route('category_page',$category->id) }}">{{$category->name}}</a></li>
            @endforeach
       @endif
        </ul>
    </div>
</div>

</div>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        <p></p>
                        <div class="view d-flex">
                        </div>
                    </div>
                    <!-- Sorting -->
                    <div class="product-sorting d-flex">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        @if(isset($products) && count($products)>0)
            @foreach($products as $product)
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                <div class="single-product-wrapper">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="{{ asset('assets/images/product/').'/'.$product->productimages[0]->image }}" alt="">
                        <!-- Hover Thumb -->
                        <img class="hover-img" src="{{ asset('assets/images/product/').'/'.$product->productimages[1]->image }}" alt="">
                    </div>
                    <!-- Product Description -->
                    <div class="product-description d-flex align-items-center justify-content-between">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{$product->code}}</p>
                            <a href="{{ url('category/'.$product['category_id'].'/product/'.$product['id']) }}">
                                <h6>{{$product->name}}</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-12">
            <div class="single-product-wrapper">
                <div class="product-img">
                    <img src="{{ asset('assets/images/product/nodata-found.jpg') }}" alt="">
                </div>
            </div>
        </div>
        @endif
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Pagination -->
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">
                    {{ $products->appends($_GET)->render() }} 
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('customScript')
@endsection


