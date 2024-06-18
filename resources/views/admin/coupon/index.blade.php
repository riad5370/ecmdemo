@extends('admin.include.master')
@push('css')
<link rel="stylesheet" href="{{asset('admin-asset')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
@endpush
@section('body')
<div style="background-color: #3498DB; width:100%;height:190px;">
    <div class="">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 12px 50px 0 100px;">Coupon Information</h2>
    <h6 style="margin-top: 2px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active">Coupon</li>
        </ul>
    </h6>
    </div>
        <?php
        $categoryCount = $coupons->count();    
       ?>
    <div class="">
        <div class="col-xs-8" style="margin-top: 0;">
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">All Coupon ({{$categoryCount}})</div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">S/N</th>
                            <th class="center">Coupon</th>
                            <th class="center">Discount</th>
                            <th class="center">Expire Date</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key=>$coupon)
                        <tr role="row" class="">
                            <td class="center">{{$key+1}}</td>
                            <td class="center">{{ $coupon->name ?: 'null' }}</td>
                            <td class="center">{{ $coupon->discount}}</td>
                            <td class="center">{{ $coupon->expire}}</td>
                            <td class="center">
                                <div class="hidden-sm hidden-xs action-buttons">
                                    <form action="{{route('coupons.destroy',$coupon->id)}}" method="POST" id="delete-form-{{$coupon->id}}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <i class="red ace-icon fa fa-trash-o bigger-130" onclick="confirmAndSubmit({{$coupon->id}})"></i>
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
                    <h4 class="widget-title">Add Coupon</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form action="{{ route('coupons.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Coupon Name</label>
                                        <input type="text"  name="name" class="form-control" placeholder="Name">
                                        @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Discount%:</label>
                                        <input type="number" name="discount" class="form-control" placeholder="Discount">
                                        @error('discount')
                                        <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Expire Date:</label>
                                        <input type="date" name="expire" class="form-control">
                                        @error('expire')
                                        <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Coupon Type</label>
                                        <select name="type" class="form-control">
                                            <option value="">--select type--</option>
                                            <option value="1">Percentage</option>
                                            <option value="2">Solid Amount</option>
                                        </select>
                                        @error('type')
                                        <strong class="text-danger">{{$message}}</strong>
                                        @enderror
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
                  null,null,null, 
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