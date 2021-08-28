@extends('admin.layouts.app')
@section('title', 'Change Password')
@section('breadcrumb')
    @include('admin.layouts.breadcrumbs', [
        'breadcrumbs' => [
			'Dashboard' => '',

        ]
    ])
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Change Password</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
        <form method="POST" enctype="multipart/form-data"  action="{{ route('admin_change_password_check') }}" onsubmit="save.disabled = true; return true;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        @if($errors->any())
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          @foreach($errors->all() as $error)
            <p>{!! $error !!}</p>
          @endforeach
        </div>
        @endif
        <div class="box-body">
        <div class="row">
               <div class="col-md-6">
                  <div class="col-md-6 col-sm-6">
                     <div class="form-group custom-form-group">
                        <!--Add error class to show error-->
                        <label class="label-text"> Current Password</label>
                        <div class="input-wraper">
                           <input type="password" name="old_password" class="form-control icon-input" placeholder="Current Password" required/>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="col-md-6 col-sm-6">
                     <div class="form-group custom-form-group">
                        <!--Add error class to show error-->
                        <label class="label-text">New Password</label>
                        <div class="input-wraper">
                           <input type="password" name="password" class="form-control icon-input" placeholder="New Password" required  />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="col-md-6 col-sm-6">
                     <div class="form-group custom-form-group">
                        <!--Add error class to show error-->
                        <label class="label-text">Confirm Password</label>
                        <div class="input-wraper">
                           <input type="password" name="password_confirmation" class="form-control icon-input" placeholder="Confirm Password" required />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
            <div class="box-footer">
               <div class="row">
                  <div class=" col-md-6">
                     <button type="submit"  name="save" class="btn_blue_ebc_submit" id="submit" >Update Password</button>
                  </div>
               </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection