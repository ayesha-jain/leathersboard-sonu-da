@extends('layouts.app')

@section('pageTitle','Welcome to abstract management')

@section('customStyle')
@endsection

@section('content')
<!-- Product Catagories Area Start -->
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">

        <!-- Single Catagory -->
        @if(isset($categories) && count($categories)>0)
        @foreach($categories as $category)
        <div class="single-products-catagory clearfix">
            <a href="{{route('category_page',$category['id'])}}">
                <img src="{{ asset('assets/images/category/').'/'.$category->image }}" alt="">
                <div class="hover-content">
                    <div class="line"></div>
                    <p></p>
                    <h4>{{$category->name}}</h4>
                </div>
            </a>
        </div>
        @endforeach
       @endif

    </div>
</div>
<!-- Product Catagories Area End -->
</div>
@endsection

@section('customScript')
@endsection


