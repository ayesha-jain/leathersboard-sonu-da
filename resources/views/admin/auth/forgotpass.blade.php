<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EBC abstracts manager | Admin | Forgot password</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin_login_assets/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_login_assets/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin_login_assets/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_login_assets/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin_login_assets/css/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('admin_assets/AdminLTE/dist/css/admin_custom.css') }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .help-block {
      color: red;
    }
    .failed{
      text-align: center;
      color: red;
    }
    .align_items_between{
      display:flex;
      justify-content:space-between;
      align-items:center;
    }
    .back_btn,.back_btn:hover,.back_btn:focus{
      display:flex;
      justify-content:flex-end;
      align-items:center;
      height:45px;
      text-decoration:none;
      color:#015da8;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo new_text_logo">
	<!-- <img src="{{ asset('web_assets/images/logo.png') }}" class="img-circle" alt="User Image"> -->
  <h1><span>EBC</span>ABSTRACTS MANAGER</h1> 
  </div>
  <div class="login-logo">
  <h4 style="font-weight:bold;">EBC Abstracts Manager - Admin area</h4>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Forgot Password </p>
  	@if(session()->has('message'))
  	<div class="alert alert-error alert-dismissible">
  	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	  <h4><i class="icon fa fa-close"></i> Autehntication Failed!</h4>
  	    {{ session()->get('message') }}
  	 </div>
    @endif
    @if(session()->has('successmessage'))
  	<div style="background-color:  #17b047" class="alert alert-dismissible">
  	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	  <h4 style="color: #fff;"> Thank You,</h4>
  	   <span  style="color: #fff;"> {{ session()->get('successmessage') }}</span>
  	 </div>
    @endif
    <form action="{{ route('admin_forgot_password_save') }}" method="post">
        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" autofocus  value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      
      <div class="row align_items_between">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" style="width: 116%;" class="btn_yellow_ebc">Submit</button>
         
        </div>
        <div class="col-xs-8">
          <a class="back_btn" href="javascript:void(0);" onclick="goBack()">
             back
          </a>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('admin_login_assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin_login_assets/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin_login_assets/js/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
 
</script>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>




