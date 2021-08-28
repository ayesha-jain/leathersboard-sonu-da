<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="{!! asset('admin_assets/AdminLTE/dist/img/default-admin.png') !!}" alt="User Avatar" class="img-size-32 mr-3 img-circle">
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-menu-right">

                <li>
                    <a href="{{ route('admin_log_out') }}" class="dropdown-item" >{{ __('Logout') }}</a>
                    
                </li>
            </ul>
        </li>
    </ul>
</nav>