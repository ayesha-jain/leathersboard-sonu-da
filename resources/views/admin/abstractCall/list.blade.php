@extends('admin.layouts.app')

@if($type==0)
    @section('title', 'Inapproved Abstract')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Call for abstracts List' => '',

            ]
        ])
    @endsection
@else
    @section('title', 'Call for abstracts List')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Call for abstracts List' =>'',

            ]
        ])
    @endsection
@endif
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
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=0; ?>
                                        @if(isset($abstract) && count($abstract)>0)
                                            @foreach($abstract as $value)
                                            <tr>
                                                <td>{{++$count}}</td>
                                                <td>{{$value->title}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->start_date))}}</td>
                                                <td>{{date('d/m/Y', strtotime($value->end_date))}}</td>
                                                <td> <img src="{{ asset('web_assets/images/call_abstract/').'/'.$value->image }}" height="100" width="100" alt="image" /></td>
                                                <td>
                                                    <div class="btn_row_table">
                                                    {{-- @if($type==0) --}}
                                                        {{-- <a title="View" href="{{ route('inapproved_banner_view') }}/{{$value['id']}}"><i class="fa fa-check"></i></a> --}}
                                                        <a title="Edit" class="circle_btn_edit" href="{{ route('abstract_call_edit') }}/{{$value['id']}}"><i class="fa fa-edit"></i></a>
                                                        <a id="delete" href=# data-id="{{$value->id}}" class="prizecross-btn circle_btn_del"><i class="fa fa-trash"></i></a>
                                                        {{-- <a title="Delete" href="#" ><i class="fa fa-trash"></i></a> --}}
                                                    {{-- @else
                                                        <a  title="View" class="circle_btn_edit" href="{{ route('approved_banner_view') }}/{{$value['id']}}"><i class="fa fa-eye"></i></a>
                                                        <a  title="Edit" class="circle_btn_edit" href="{{ route('approved_banner_edit') }}/{{$value['id']}}"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    </div>                                                <!-- <a href="#" ><i class="fa fa-trash"></i></a> --> --}}
                                                </td>
                                            </tr>
                                            @endforeach
											@else
											<tr>
												<td colspan="8">
													<?php echo "No Data Found"; ?>
												</td>
											</tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					<div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                        {{ $abstract->links() }}
                     </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('customScripts')
<script>
      
      
      $(document).ready(function () {
        
           $(document).on("click", "#delete", function () {
            // var id = $(this).attr("data-id");
            // //console.log(id);
            var r = confirm("Are you sure to delete!");
            if (r == true) {
                var id = $(this).attr("data-id");
                //console.log(id);
                $.ajax({
                    type: "GET",
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    //data: {'id' : id},
                    url: "abstract/delete/"+id,
                    success: function(result) {
                     //var myJSON = JSON.stringify(result);
                     //var obj = $.parseJSON(result);
                     //alert(result);
                     //alert(myJSON.success);
                     if(!result){
                        alert('You Cannot delete this call for abstracts. Scientists have added abstracts in this call for astract');
                    }
                    else{
                        location.reload();
                    }
                    }
                }).done(function( msg ) {
                });
            }
            else {
                txt = "You pressed Cancel!";
            }
        });


                 
         });
      
   </script>

@endsection
