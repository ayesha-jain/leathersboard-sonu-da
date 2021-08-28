<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{!! asset('admin_assets/AdminLTE/dist/img/default-admin.png') !!}" alt="Admin" class="img-circle elevation-2">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> --}}

<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('admin_dashboard') }}" class="nav-link{{ Route::currentRouteName() == 'admin_dashboard'?' active': '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <!--<i class="right fas fa-angle-left"></i>-->
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview{{ in_array(Route::currentRouteName(), ['category.index', 'category.edit','category.create','category_delete.']) ? ' menu-open': '' }}">
                <a href="#" class="nav-link {{ in_array(Route::currentRouteName() ,['category.index','category.edit','category.create','category_delete.'] ) ?' active': '' }}">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Categories
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('category.index')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['category.index', 'category.edit']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('category.create')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['category.create']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview{{ in_array(Route::currentRouteName(), ['product.index', 'product.edit','product.create','product_delete.']) ? ' menu-open': '' }}">
                <a href="#" class="nav-link {{ in_array(Route::currentRouteName() ,['product.index','product.edit','product.create','product_delete.'] ) ?' active': '' }}">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Products
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('product.index')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['product.index', 'product.edit']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('product.create')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['product.create']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview{{ in_array(Route::currentRouteName(), ['contact_list']) ? ' menu-open': '' }}">
                <a href="#" class="nav-link {{ in_array(Route::currentRouteName() ,['contact_list'] ) ?' active': '' }}">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Contacts
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('contact_list')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['contact_list']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview{{ in_array(Route::currentRouteName(), ['email_list']) ? ' menu-open': '' }}">
                <a href="#" class="nav-link {{ in_array(Route::currentRouteName() ,['email_list'] ) ?' active': '' }}">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Emails
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('email_list')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['email_list']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview{{ in_array(Route::currentRouteName(), ['send-mail.index', 'send-mail.edit','send-mail.create','send_email_delete.']) ? ' menu-open': '' }}">
                <a href="#" class="nav-link {{ in_array(Route::currentRouteName() ,['send-mail.index','send-mail.edit','send-mail.create','send_email_delete.'] ) ?' active': '' }}">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                    Send Email
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('send-mail.index')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['send-mail.index', 'send-mail.edit']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('send-mail.create')}}" class="nav-link{{ in_array(Route::currentRouteName(), ['send-mail.create']) ? ' active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
  <!-- /.sidebar-menu -->
</div>