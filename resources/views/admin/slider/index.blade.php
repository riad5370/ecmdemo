@extends('admin.include.master')
@push('css')
<link rel="stylesheet" href="{{ asset('admin-asset/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
@endpush

@section('body')
    <div style="background-color: #3498DB; width: 100%; height: 190px;">
        <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Sliders Information</h2>
        <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
            <ul class="breadcrumb" style="padding: 0; margin: 0;">
                <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
                <li class="active">Slider</li>
            </ul>
        </h6>
        <?php $sliderCount = $sliders->count(); ?>
        <div>
            <div class="col-xs-8" style="margin-top: 0;">
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">All Sliders ({{ $sliderCount }})</div>
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">S/N</th>
                                <th class="center">Image</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $key => $slider)
                            <tr role="row" class="">
                                <td class="center">{{ $key + 1 }}</td>
                                <td class="center">
                                    @if ($slider->image)
                                        <img width="50px" src="{{ asset('images/sliders/' . $slider->image) }}" alt="">
                                    @else
                                        <span>null</span>
                                    @endif
                                </td>
                                <td class="center">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="{{ route('sliders.edit', $slider->id) }}">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" id="delete-form-{{ $slider->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <i class="red ace-icon fa fa-trash-o bigger-130" onclick="confirmAndSubmit({{ $slider->id }})"></i>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-4 col-md-4 col-sm-4" style="margin-top: 0;">
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="widget-box" style="margin-top: 0; padding-top: 0;">
                    <div class="widget-header">
                        <h4 class="widget-title">Add Slider</h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="">Image:</label>
                                        <label class="ace-file-input">
                                            <input name="image" type="file" id="id-input-file-2" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            <span class="ace-file-container" data-title="Choose">
                                                <span class="ace-file-name" data-title="No File ...">
                                                    <i class="ace-icon fa fa-upload"></i>
                                                </span>
                                            </span>
                                            <a class="remove" href="#"><i class="ace-icon fa fa-times"></i></a>
                                        </label>
                                        <img src="" width="70px;" id="blah" alt="">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Save
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" id="cancelButton">
                                            <i class="ace-icon fa fa-times bigger-110"></i>
                                            Cancel
                                        </button>
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
<script src="{{ asset('admin-asset/js/chosen.jquery.min.js') }}"></script>

<script type="text/javascript">
    document.getElementById('cancelButton').addEventListener('click', function() {
        location.reload();
    });

    function confirmAndSubmit(productId) {
        if (confirm('Are You Sure Delete This!')) {
            document.getElementById('delete-form-' + productId).submit();
        }
    }

    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "bottom",
            position: "left",
            stopOnFocus: true,
            backgroundColor: "rgba(40, 167, 69, 0.9)"
        }).showToast();
    @endif
</script>
@endpush
