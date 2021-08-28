@extends('admin.layouts.app')
@if(!empty($data['id']))
    @section('title', 'Category Edit')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Category' => route('category.index'),
                'Edit #' . $data['id'] => ''
            ]
        ])
    @endsection
@else
    @section('title', 'Category Add')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Category' => route('category.index'),
                'Add' => ''
            ]
        ])
    @endsection
@endif
@section('customCss')
<link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    .btn-info-yellow {
    background-color: #f8b121; 
    border-color: #f8b121;
    box-shadow: none;
}
.btn-info-yellow:hover {
    text-decoration: none;
}
</style>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    @if(!empty($data['id']))
                    <h3 class="card-title">Edit</h3>
                    @else
                    <h3 class="card-title">Add</h3>
                    @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $error)
                        <p>{!! $error !!}</p>
                    @endforeach
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! session('success') !!}
                    </div>
                    @endif
                    <input type="hidden" name="id" class="form-control icon-input" @if(!empty($data['id'])) value="{{$data['id']}}"  @endif    />
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-8">
                                <input type="text" name="user" class="form-control" placeholder="Enter User"/>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-8">
                                <input type="text"  name="subject" class="form-control" placeholder="Enter Subject" />
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Mail Body</label>
                            <div class="col-sm-8">
                                <textarea name="mail_body" id="mail_body" maxlength="1200" class="form-control"  pattern="[^\s][^]*" title="Can use digits,upper and lower letters, and spaces but must not start with a space" required></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" name="save" id="submit" class="btn_yellow_ebc">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScripts')
@endsection