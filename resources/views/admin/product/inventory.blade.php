@extends('admin.include.master')
@push('css')
<link rel="stylesheet" href="{{asset('admin-asset')}}/css/chosen.min.css" />
<!-- ace styles -->
<link rel="stylesheet" href="{{asset('admin-asset')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
@endpush
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Product Inventory</h2>
    <h6 style="margin-top: 0px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Product</li>
            <li class="active">Inventory</li>
        </ul>
    </h6>
    <?php
    $categoryCount = $inventories->count();    
   ?>
<div class="">
    <div class="col-xs-8" style="margin-top: 0;">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">Inventory List ({{$categoryCount}})</div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">S/N</th>
                        <th class="center">Product name</th>
                        <th class="center">Color name</th>
                        <th class="center">Size name</th>
                        <th class="center">Quantity</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $key=>$inventory)
                        <tr>
                            <td class="center">{{$key+1}}</td>
                            <td class="center">{{ $inventory->product->name ?? 'N/A' }}</td>
                            <td class="center">{{ $inventory->color->name ?? 'N/A' }}</td>
                            <td class="center">{{ $inventory->size->name ?? 'N/A' }}</td>
                            <td class="center">{{$inventory->quantity}}</td>
                            <td class="center">
                                <a href="{{route('inventory.delete',$inventory->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @foreach ($subcategories as $key=>$subcategory)
                    <tr role="row" class="">
                        <td class="center">{{$key+1}}</td>
                        <td class="center">{{ $subcategory->category->name ?: 'Unknown Category' }}</td>
                        <td class="center">{{ $subcategory->name}}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="{{route('subcategories.edit',$subcategory->id)}}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <form action="{{route('subcategories.destroy',$subcategory->id)}}" method="POST" id="delete-form-{{$subcategory->id}}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <i class="red ace-icon fa fa-trash-o bigger-130" onclick="confirmAndSubmit({{$subcategory->id}})"></i>
                            </div>
                        </td>
                    </tr>
                    @endforeach --}}
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
                <h4 class="widget-title">Add Inventory</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form action="{{route('inventory.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control mt-3" readonly value="{{$product->name}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Color</label>
                                    <select class="chosen-select form-control" id="form-field-select-1" name="color_id" data-placeholder="Choose a Color...">
                                        <option value=""></option>
                                        @foreach ($colors as $color)
                                         <option value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Size</label>
                                    <select class="chosen-select form-control" id="form-field-select-1" name="size_id" data-placeholder="Choose a Size...">
                                        <option value=""></option>
                                        @foreach ($sizes as $size)
                                         <option value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                                </div>
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
<script src="{{asset('admin-asset')}}/js/chosen.jquery.min.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($){
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true}); 

            // $('#chosen-multiple-style .btn').on('click', function(e){
            //     var target = $(this).find('input[type=radio]');
            //     var which = parseInt(target.val());
            //     if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
            //      else $('#form-field-select-4').removeClass('tag-input-style');
            // });
        }

    });
</script> 
<script>
    document.getElementById('cancelButton').addEventListener('click', function() {
        location.reload();
    });
</script>
@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "bottom",
            position: "left",
            stopOnFocus: true,
            backgroundColor: "rgba(40, 167, 69, 0.9)"
        }).showToast();
    </script>
@endif
@endpush