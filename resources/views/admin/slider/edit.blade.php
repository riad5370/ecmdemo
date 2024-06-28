@extends('admin.include.master')
@section('body')
<div class="main-content-inner font">
    <div class="col-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Slider Edit</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form action="{{ route('sliders.update', $slider->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    
                        {{-- Image --}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">Image (optional):</label>
                            <div class="col-sm-7">
                                <input type="file" id="image" name="image" class="form-control" onchange="previewImage(this)">
                                <br>
                                <img src="{{ $slider->image ? asset('images/sliders/' . $slider->image) : '' }}" width="70px;" id="blah" alt="">
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
                                <a href="{{ route('sliders.index') }}" class="btn btn-sm btn-danger">
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

{{-- live image preview --}}
<script>
    function previewImage(input) {
        var blah = document.getElementById('blah');
        if (input.files && input.files[0]) {
            blah.src = window.URL.createObjectURL(input.files[0]);
        } else {
            blah.src = '';
        }
    }
</script>
@endsection
