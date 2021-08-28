@extends('admin.layouts.app')
@section('title', 'Send Email')
@section('breadcrumb')
    @include('admin.layouts.breadcrumbs', [
        'breadcrumbs' => [
			'Dashboard' => route('admin_dashboard'),
            'Send Email List' => ''
        ]
    ])
@endsection
@section('customCss')
<style>
        .tags {
            list-style: none;
            margin: 0;
            overflow: hidden;
            padding: 0;
        }
        
        .tags li {
            float: left;
        }
        
        .tag {
            background: crimson;
            border-radius: 3px 0 0 3px;
            color: #fff;
            display: inline-block;
            height: 26px;
            line-height: 26px;
            padding: 0 20px 0 23px;
            position: relative;
            margin: 0 10px 10px 0;
            text-decoration: none;
        }
        
        .tag::before {
            background: #fff;
            border-radius: 10px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
            content: '';
            height: 6px;
            left: 10px;
            position: absolute;
            width: 6px;
            top: 10px;
        }
        
        .tag::after {
            background: #fff;
            border-bottom: 13px solid transparent;
            border-left: 10px solid crimson;
            border-top: 13px solid transparent;
            content: '';
            position: absolute;
            right: 0;
            top: 0;
        }
        
        .green-tag {
            background: #42B329;
        }
        
        .green-tag::after {
            border-left-color: #42B329;
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
                                            <th>Subject</th>
                                            <th>Mail Body</th>
                                            <th>Emails</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=0; ?>
                                        @if(isset($data) && count($data)>0)
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{++$count}}</td> 
                                            <td>{{$value->subject}}</td>
                                            <td>{{$value->mail_body}}</td>                                            
                                            <td> 
                                            @if(isset($value->useremails) && count($value->useremails)>0)
                                                @foreach($value->useremails as $email)
                                                <li class="tag">{{$email->email}}</li>
                                                @endforeach
                                            @endif
                                            </td>
                                            <td>
                                              <div class="btn_row_table">
                                                <a title="Delete" href="{{route('send_email_delete',$value['id'])}}"  onclick="return confirm('Are you sure want to delete?');" class="prizecross-btn circle_btn_del"><i class="fa fa-trash"></i></a>
                                               </div>
                                            </td>
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