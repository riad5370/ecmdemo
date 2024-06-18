@extends('admin.include.master')
@section('body')
<div class="">
    <div class="col-xs-12 col-md-12 col-sm-12" style="margin-top: 0;">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="widget-box" style="margin-top: 0; padding-top:0;">
            <div class="widget-header">
                <h4 class="widget-title">Add Product Variation</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form action="{{route('variation.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-3 col-sm-3 col-xl-3">
                                <label for="form-field-select-1">Option Name:</label>
                            </div>
                            <div class="col-md-9 col-9 col-sm-9 col-xl-9">
                                <select class="chosen-select form-control js-example-basic-single" name="option_name" id="option_name" data-placeholder="Choose a Category...">
                                    <option>-- select option --</option>
                                    <option value="color">Color</option>
                                    <option value="size">Size</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row align-items-center">
                            <label class="col-sm-3 col-form-label form-label-title">Option Value</label>
                            <div class="col-sm-9">
                                <div class="bs-example">
                                    <input type="text" class="form-control" placeholder="Type tag & hit enter" id="option_value"
                                        data-role="tagsinput" name="option_value">
                                </div>
                            </div>
                        </div><br>
                        <div class="row align-items-center" id="color_fields" style="display: none;">
                            <label class="col-sm-3 col-form-label form-label-title">Color Code</label>
                            <div class="col-sm-9">
                                <div class="bs-example">
                                    <input type="text" class="form-control" placeholder="Enter color code" id="color_code"
                                        name="color_code">
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

<div class="col-12 col-md-12 col-xs-12">
    <div class="widget-box">
        <div class="row" style="padding:10px 0px">
            <div class="col-md-6">
                <div class="col-xs-12">
                    <div class="table-header">
                        Size List
                    </div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">Si</th>
                                <th class="center">Name</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sizes as $index => $size)
                                <tr>
                                    <td class="center">{{$index+1}}</td>
                                    <td class="center">{{$size->name}}</td>
                                    <td class="btn-group" style="display: flex ; justify-content: center">
                                        <form action="{{ route('variation.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$size->id}}">
                                            <input type="submit" name="delete1" value="Delete" class="btn btn-danger btn-sm"  onclick="return confirm('Are You Sure Delete This!')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-xs-12">
                    <div class="table-header">
                        Color List 
                    </div>
                    <table id="dynamic-table1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">Si</th>
                                <th class="center">Name</th>
                                <th class="center">Color Code</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($colors as $index => $color)
                                <tr>
                                    <td class="center">{{$index+1}}</td>
                                    <td class="center">{{$color->name}}</td>
                                    <td class="center">
                                        <span class="badge rounded-pill" style="background-color: {{ $color->color_code }}">{{$color->name}}</span>
                                    </td>
                                    <td class="btn-group" style="display: flex ; justify-content: center">
                                        <form action="{{ route('variation.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$color->id}}">
                                            <input type="submit" name="delete2" value="Delete" class="btn btn-danger btn-sm"  onclick="return confirm('Are You Sure Delete This!')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('admin-asset/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-asset/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionNameSelect = document.getElementById('option_name');
        const colorFields = document.getElementById('color_fields');
        const colorCodeInput = document.getElementById('color_code');

        optionNameSelect.addEventListener('change', function() {
            const selectedOption = this.value;
            if (selectedOption === 'color') {
                colorFields.style.display = 'block';
            } else {
                colorFields.style.display = 'none';
                colorCodeInput.value = '';
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery(function($) {
        //initiate dataTables plugin
        var myTable = 
        $('#dynamic-table')
        .DataTable( {
            bAutoWidth: false,
            "aoColumns": [
              { "bSortable": false },
              null, 
              { "bSortable": false }
            ],
            
        } );

        var myTable = 
        $('#dynamic-table1')
        .DataTable( {
            bAutoWidth: false,
            "aoColumns": [
              { "bSortable": false },
              null,null,  
              { "bSortable": false }
            ],
            
        } );
    })
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