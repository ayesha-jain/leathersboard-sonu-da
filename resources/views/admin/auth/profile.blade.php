@extends('admin.layouts.app')
@section('title', 'Profile')
@section('breadcrumb')
    @include('admin.layouts.breadcrumbs', [
        'breadcrumbs' => [
            'Dashboard' => route('admin_dashboard'),
        ]
    ])
@endsection
@section('customCss')
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin_profile_save') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    {{-- <input type="hidden" name="type" value="{{ $type }}"/> --}}
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
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="first_name" placeholder="Enter The First Name" @if(!empty($profile->first_name)) value="{{$profile->first_name}}" @else  value="{{ old('first_name') }}"  @endif   />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="last_name" placeholder="Enter The Last Name" @if(!empty($profile->last_name)) value="{{$profile->last_name}}" @else  value="{{ old('last_name') }}"  @endif   />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" placeholder="Enter The Email" @if(!empty($profile->email)) value="{{$profile->email}}" @else  value="{{ old('email') }}"  @endif   />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" placeholder="Enter The Phone Number" @if(!empty($profile->phone)) value="{{$profile->phone}}" @else  value="{{ old('phone') }}"  @endif   />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Profile Picture</label>
                            <div class="col-sm-8">
                                <img  id="profile-page-upload-btn"  />
                                @if(isset($profile->profile_picture))
                                <img id ="img" height="100" width="100" src="{{ asset('web_assets/images/profilePicture/').'/'.$profile->profile_picture }}" alt="your image"  />
                                <input type="file"  id="upload" accept="image*" name="profile_picture"  value="{{ asset('web_assets/images/profilePicture/').'/'.$profile['profile_picture'] }}" style=" padding-bottom: 8px;" >
                                @else
                                <img id ="img" height="100" width="100"   />
                                <input type="file"  id="upload" accept="image*" name="profile_picture"  style=" padding-bottom: 8px;" >
                                @endif
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
<script>
 $(function(){
        $('#upload').change(function(){
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
        });
    });
</script>
@endsection
