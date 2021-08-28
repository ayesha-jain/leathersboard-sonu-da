@extends('admin.layouts.app')
@if($type == 'add' )
    @section('title', 'Add a call for abstracts')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Call for abstracts List' => route('abstract_call_list'),
                'Add a call for abstracts' => ''
            ]
        ])
    @endsection
@else
    @section('title', 'Edit a call for abstracts')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Call for abstracts List' => route('abstract_call_list'),
                'Edit a call for abstracts' .'/'. $abstract['id'] => ''
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
                    <h3 class="card-title">@if($type=='edit') Edit @else Add @endif</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('abstract_call_save') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
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
                    <input type="hidden" name="id" class="form-control icon-input"   @if(!empty($abstract['id'])) value="{{$abstract['id']}}"  @endif    />
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" placeholder="Enter the abstracts call title" @if(!empty($abstract['title'])) value="{{$abstract['title']}}" @else  value="{{ old('title') }}"  @endif required  />
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Summary</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="excerpt" placeholder="Enter the summary">@if(!empty($abstract['description'])) {{$abstract['description']}} @else{{ old('excerpt') }}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Text</label>
                            <div class="col-sm-8">
                            <textarea name="text" id="text" > @if(!empty($abstract['text'])) {!!$abstract['text']!!} @else{{ old('text') }}@endif </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control float-right datepicker1" name="start_date" id="start_date" placeholder = "Enter the start date"@if(!empty($abstract['start_date'])) value="{{$abstract['start_date']}}" @elseif(!empty(old('start_date'))) value="{{old('start_date')}}"   @endif required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control float-right datepicker2" name="end_date" id="end_date" placeholder = "Enter the end date"@if(!empty($abstract['end_date'])) value="{{$abstract['end_date']}}" @elseif(!empty(old('end_date'))) value="{{old('end_date')}}"   @endif required>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Reviewing start date</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control float-right datepicker3" name="reviewing_start_date" id="reviewing_start_date" placeholder = "Enter the reviewing start date"@if(!empty($abstract['reviewing_start_date'])) value="{{$abstract['reviewing_start_date']}}" @elseif(!empty(old('reviewing_start_date'))) value="{{old('reviewing_start_date')}}"   @endif required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Reviewing end date</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control float-right datepicker4" name="reviewing_end_date" id="reviewing_end_date" placeholder = "Enter the reviewing end date"@if(!empty($abstract['reviewing_end_date'])) value="{{$abstract['reviewing_end_date']}}" @elseif(!empty(old('reviewing_end_date'))) value="{{old('reviewing_end_date')}}"   @endif required>
                            </div>
                        </div>


                        @if($type=='edit')
                        {{-- @if($abstract['status'] == 0) --}}
                        <div class="form-group row">
                         <label for="inputPassword3" class="col-sm-2 col-form-label">Authorize posters</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="radio_area" >
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="authorize_poster" @if($abstract['authorize_poster']== '1') checked  @endif  value="1">
                                            <label for="customRadio1" class="custom-control-label">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="authorize_poster" @if($abstract['authorize_poster']== '0') checked @endif value="0">
                                            <label for="customRadio2" class="custom-control-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @endif --}}
                        @else
                        <div class="form-group row">
                         <label for="inputPassword3" class="col-sm-2 col-form-label"> Authorize posters</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="radio_area" >
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="authorize_poster"  value="1">
                                            <label for="customRadio1" class="custom-control-label">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="authorize_poster" value="0">
                                            <label for="customRadio2" class="custom-control-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Picture feature (banner)</label>
                            <div class="col-sm-8">
                                <img  id="profile-page-upload-btn"  />
                                @if($type!='add')
                                <img id ="img" height="100" width="100" src="{{ asset('web_assets/images/call_abstract/'.$abstract['image']) }}" alt="your image"  />
                                <input type="file"  id="upload" accept="image*" name="image"  value="{{ asset('web_assets/images/call_abstract/').'/'.$abstract['image'] }}" style=" padding-bottom: 8px;" >
                                @else
                                <img id ="img" height="100" width="100" src="{{ asset('admin_login_assets/images/no-images.png') }}" alt="your image"  />
                                <input type="file"  id="upload" accept="image*" name="image"  style=" padding-bottom: 8px;" >
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="select2" multiple="multiple" name="category[]" data-dropdown-css-class="select2-purple"  data-placeholder="Select categories" style="width: 100%;">
                                    <option value="">Select the category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"  @if(!empty($callAbstractCategories_val) > 0 && in_array($category->id,$callAbstractCategories_val)) selected @elseif(!empty(old('category')) && in_array($category->id,old('category'))) selected @else   @endif> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="form_footer_ebc">
                        <button type="submit" name="save" id="submit" class="btn_yellow_ebc">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="{{ asset('admin_assets/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}" ></script>
  <script type="text/javascript">

    CKEDITOR.replace( 'text', {
					// Define the toolbar groups as it is a more accessible solution.
					toolbarGroups: [
						{"name":"basicstyles","groups":["basicstyles"]},
						{"name":"links","groups":["links"]},
						{"name":"paragraph","groups":["list"]},
						// {"name":"document","groups":["mode"]},
						// {"name":"insert","groups":["insert"]},
						// {"name":"styles","groups":["styles"]},
						// {"name":"about","groups":["about"]}
					],
					// Remove the redundant buttons from toolbar groups defined above.
					removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
				});

</script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    });
            $('.datepicker1').attr("autocomplete", "off");
			$('.datepicker1').datepicker({
                format: 'yyyy-mm-dd',
		      autoclose: true
		    });
            $('.datepicker2').attr("autocomplete", "off");
			$('.datepicker2').datepicker({
                format: 'yyyy-mm-dd',
		      autoclose: true
		    });
            $('.datepicker3').attr("autocomplete", "off");
			$('.datepicker3').datepicker({
                format: 'yyyy-mm-dd',
		      autoclose: true
		    });
            $('.datepicker4').attr("autocomplete", "off");
			$('.datepicker4').datepicker({
                format: 'yyyy-mm-dd',
		      autoclose: true
		    });
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
