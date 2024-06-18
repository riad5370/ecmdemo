@extends('admin.include.master')
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Brand Information</h2>
    <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Brand</li>
        </ul>
    </h6>
        <?php
        $brandCount = $brands->count();    
        ?>
    <div class="">
        <div class="col-xs-8" style="margin-top: 0;">
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">All Brands ({{$brandCount}})</div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">S/N</th>
                            <th class="center">Brand Name</th>
                            <th class="center">Image</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key=>$brand)
                        <tr role="row" class="">
                            <td class="center">{{$key+1}}</td>
                            <td class="center">{{$brand->name}}</td>
                            <td class="center">
                                @if ($brand->image)
                                    <img width="50px" src="{{ asset('images/brand/' . $brand->image) }}" alt="">
                                @else
                                    <span>null</span>
                                @endif
                            </td>
                            <td class="center">
                                <div class="hidden-sm hidden-xs action-buttons">
                                   
                                    <a class="green" href="{{ route('brands.edit', $brand->id) }}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" id="delete-form-{{ $brand->id }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                    <i class="red ace-icon fa fa-trash-o bigger-130" onclick="confirmAndSubmit({{ $brand->id }})"></i>
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

            <div class="widget-box" style="margin-top: 0; padding-top:0;">
                <div class="widget-header">
                    <h4 class="widget-title">Add Product Brand</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Brand Name<span style="color:#B74635; font-weight:bold;">*</span>:</label>
                                        <input type="text" name="name" placeholder="Brand Name" class="form-control" />
                                        <span>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label for="">Image (optional):</label>
                                     <label class="ace-file-input"><input name="image" type="file" id="id-input-file-2" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
                                     <img src="" width="70px;" id="blah" alt="">
                                     <span>
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
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
<script src="{{ asset('admin-asset/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-asset/js/jquery.dataTables.bootstrap.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($){
         //initiate dataTables plugin
         var myTable = 
            $('#dynamic-table')
            .DataTable( {
                bAutoWidth: false,
                "aoColumns": [
                  { "bSortable": false },
                  null,null, 
                  { "bSortable": false }
                ],
                
            } );
    });
</script> 
<script>
    document.getElementById('cancelButton').addEventListener('click', function() {
        location.reload();
    });
</script>
<script>
    function confirmAndSubmit(productId) {
        if (confirm('Are You Sure Delete This!')) {
            document.getElementById('delete-form-' + productId).submit();
        }
    }
</script>
@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000, // Duration in milliseconds
            close: true,
            gravity: "bottom", // Display position: top, bottom, center
            position: "left", // Alignment: left, right, center
            stopOnFocus: true, // Stop auto hide on focus
            backgroundColor: "rgba(40, 167, 69, 0.9)" // Custom success color
        }).showToast();
    </script>
@endif
@endpush

