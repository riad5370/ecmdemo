@extends('admin.include.master')
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Brand Information Edit</h2>
    <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Brand</li>
        </ul>
    </h6>
        
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
        
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Edit Product Brand Item</h4>
                        </div>
        
                        <div class="widget-body">
                            <div class="widget-main">
                                <form action="{{ route('brands.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="name">Brand Name:</label>
                                                <input type="text" id="name" name="name" placeholder="Brand Name" value="{{$brand->name}}" class="form-control" />
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="image">Image (optional):</label>
                                                <input type="file" id="image" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                                                <img src="{{ asset('images/brand/' . $brand->image) }}" width="70px;" id="blah" alt="">
                                                <span>
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Save
                                            </button>
                                            <a href="{{route('brands.index')}}" class="btn btn-sm btn-danger">
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
        
</div>

@endsection


