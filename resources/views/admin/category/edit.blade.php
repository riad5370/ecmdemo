@extends('admin.include.master')
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Category Edit</h2>
    <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Category</li>
        </ul>
    </h6>
<div class="main-content-inner font">
    <div class="col-12 col-md-12 col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <div class="row">
                    <div class="col-md-6 col-6 col-xs-6">
                        <h4 class="widget-title">Category Edit</h4>
                    </div>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    
                        {{-- Category name  --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Category Name:</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" value="{{ $category->name }}" id="name" placeholder="Category Name" class="form-control col-xs-12 col-md-11 col-sm-12" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        {{-- Image --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Image (optional):</label>
                            <div class="col-sm-7">
                                <input type="file" id="image" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                <img src="{{ $category->image ? asset('images/Category/' . $category->image) : '' }}" width="70px;" id="blah" alt="">
                                <span>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-danger">
                                    <i class="ace-icon fa fa-times bigger-110"></i>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 {{-- live image preview  --}}
 <script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var previewLabel = document.getElementById('imagePreviewLabel');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewLabel.innerHTML = '<img src="' + e.target.result +
                    '" alt="Image Preview" style="max-width:155px;max-height:145px;">';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            previewLabel.innerHTML = '<span class="lbl"> Image Preview</span>';
        }
    }
</script>









@endsection
