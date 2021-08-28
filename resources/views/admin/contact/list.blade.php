@extends('admin.layouts.app')
@section('title', 'Product')
@section('breadcrumb')
    @include('admin.layouts.breadcrumbs', [
        'breadcrumbs' => [
			'Dashboard' => route('admin_dashboard'),
            'Contact list' => ''
        ]
    ])
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>                  
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=0; ?>
                                        @if(isset($data) && count($data)>0)
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{++$count}}</td> 
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->message}}</td>
                                            <td>{{date('d M, Y', strtotime($value->created_at))}}</td>
                                            <!-- <td>
                                              <div class="btn_row_table">
                                                <a title="Edit" class="circle_btn_edit" href="{{ url('admin/product/'.$value['id'].'/edit') }}"><i class="fa fa-edit"></i></a>
                                                <a title="Delete" href="{{route('product_delete',$value['id'])}}"  onclick="return confirm('Are you sure want to delete?');" class="prizecross-btn circle_btn_del"><i class="fa fa-trash"></i></a>
                                               </div>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                    <div class="card-footer clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection