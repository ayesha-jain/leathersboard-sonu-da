@extends('admin.layouts.app')
@if(!empty($data['id']))
    @section('title', 'Product Edit')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Product' => route('product.index'),
                'Edit #' . $data['id'] => ''
            ]
        ])
    @endsection
@else
    @section('title', 'Product Add')
    @section('breadcrumb')
        @include('admin.layouts.breadcrumbs', [
            'breadcrumbs' => [
                'Dashboard' => route('admin_dashboard'),
                'Product' => route('product.index'),
                'Add' => ''
            ]
        ])
    @endsection
@endif
@section('customCss')
<style>
    .btn-info-yellow {
    background-color: #f8b121; 
    border-color: #f8b121;
    box-shadow: none;
}
.btn-info-yellow:hover {
    text-decoration: none;
}
.img-thumbnail{
  width:100%;
  height:100px;
  object-fit: cover;
  object-position: center;
  margin:10px;
}

@media(max-width: 480px) {
  .img-thumbnail{
    height:50px;
  }
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}" data-token="{{ csrf_token() }}" onsubmit="save.disabled = true; return true;">
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
                    <input type="hidden" name="id" class="form-control icon-input"   @if(!empty($data['id'])) value="{{$data['id']}}"  @endif    />
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-8">
                                <input type="text"  name="name" class="form-control" placeholder="Enter Product Name" @if(!empty($data['name'])) value="{{$data['name']}}"  @endif />
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Description</label>
                            <div class="col-sm-8">
                            <textarea name="description" id="description" > @if(!empty($data['description'])) {!!$data['description']!!} @else{{ old('description') }}@endif </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control"  name="category_id"  value="{{ old('category_id')}}" required >
                                    <option value="" selected disabled>Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(!empty($data['category_id']) && $data['category_id'] ==  $category->id) selected   @elseif(old('category_id') == $category->id) selected  @else  @endif> {{ $category->name }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-8">
                                <img  id="profile-page-upload-btn"  />
                                @if(isset($data->productimages) && count($data->productimages)>0)
                                    @foreach($data->productimages as $image)
                                    <img width="100" height="100" id ="img"src="{{ asset('assets/images/product/'.$image['image']) }}" alt="your image"  />
                                    <input type="checkbox" id="{{$image->id}}" name="delete_images[]" value="{{$image->id}}">
                                    <label for="{{$image->id}}">delete</label><br>
                                    @endforeach
                                    <!-- <img id ="img"src="{{ asset('assets/images/product/'.$data['image']) }}" alt="your image"  />
                                    <input type="file"  id="upload" accept="image*" name="image"  value="{{ asset('assets/images/category').'/'.$data['image'] }}" style=" padding-bottom: 8px;" > -->
                                @endif
                                    <!-- <img id ="img"  /> -->
                                    <!-- <input type="file" multiple name="image[]" id="file" class="file" /> -->
                                <output id="list"></output>

                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-button" id="fileName"></div>
                                        <div class="file-select-name" id="noFile"></div>
                                        <input type="file" id="files" name="files[]" multiple />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                            </div>
                    </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-8">
                                <input type="text"  name="code" class="form-control" placeholder="Enter code" @if(!empty($data['code'])) value="{{$data['code']}}"  @endif />
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
<script src="{{ asset('ckeditor/ckeditor.js') }}" ></script>
  <script type="text/javascript">

    CKEDITOR.replace( 'description', {
				});

</script>
<script>
function deleteImage() { 
	var index = Array.from(document.getElementById('list').children).indexOf(event.target.parentNode)
  	document.querySelector("#list").removeChild( document.querySelectorAll('#list span')[index]);
    totalFiles.splice(index, 1);
    console.log(totalFiles)
}

var totalFiles = [];
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }
      
      totalFiles.push(f)

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img width=100  height="100" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>', "<button onclick='deleteImage()'>x</button><br>"].join('');

          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }
  

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>

@endsection