@extends('admin.include.master')
@push('css')

<link rel="stylesheet" href="{{asset('admin-asset')}}/css/chosen.min.css" />
<!-- ace styles -->
<link rel="stylesheet" href="{{asset('admin-asset')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
@endpush
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 20px 50px 0 100px;">SubCategory Information</h2>
    <h6 style="margin-top: 5px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">SubCategory</li>
        </ul>
    </h6>
<div class="main-content-inner font">
    <div class="col-12 col-md-12 col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <div class="row">
                    <div class="col-md-6 col-6 col-xs-6">
                        <h4 class="widget-title">SubCategory Edit</h4>
                    </div>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Category:</label>
                            <div class="col-sm-7">
                            <select class="chosen-select form-control" id="form-field-select-1" name="category_id" data-placeholder="Choose a Category...">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                 <option value="{{$category->id}}" {{ ($category->id == $subcategory->category_id?'selected':'') }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        </div>
                    
                        {{-- SubCategory name  --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">SubCategory Name:</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" value="{{ $subcategory->name }}" id="name" placeholder="SubCategory Name" class="form-control col-xs-12 col-md-11 col-sm-12" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SubCategory name  --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="name">Image:</label>
                            <div class="col-sm-7">
                                <label class="ace-file-input"><input name="image" type="file" id="id-input-file-2" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
                                <img src="{{ $subcategory->image ? asset('images/SubCategory/' . $subcategory->image) : '' }}" width="70px;" id="blah" alt="">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update
                                </button>
                                <a href="{{ route('subcategories.index') }}" class="btn btn-sm btn-danger">
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

@endsection
@push('js')
<script src="{{asset('admin-asset')}}/js/chosen.jquery.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($){
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true}); 

                $('#chosen-multiple-style .btn').on('click', function(e){
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                    else $('#form-field-select-4').removeClass('tag-input-style');
                });
            }
    });
</script> 
@endpush
