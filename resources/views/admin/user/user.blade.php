@extends('admin.include.master')
@section('body')
<form action="{{ route('users.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
    @endif

    <div class="col-12 col-md-12 col-xs-6">
        <div class="widget-box">
            <div class="widget-header">
                <div class="row">
                    <div class="col-md-6 col-6 col-xs-6">
                        <h4 class="widget-title">Create New User</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top: 15px; margin-left: 10px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="slider_name">Name :</label>
    
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" placeholder="Name"
                                class="col-xs-12 col-md-11 col-sm-12" />
                            <br> <br>
                        </div>
                    </div>
                </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="slider_name">Email :</label>

                    <div class="col-sm-10">
                        <input type="email" name="email" id="name" placeholder="Email"
                            class="col-xs-12 col-md-11 col-sm-12" />
                        <br> <br>
                    </div>
                </div>
               </div>

               <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="slider_name">Password:</label>

                    <div class="col-sm-10">
                        <input type="password" name="password" id="name" placeholder="New Password"
                            class="col-xs-12 col-md-11 col-sm-12" />
                        <br> <br>
                    </div>
                </div>
            </div>
           <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="slider_name">Confirm Password :</label>

                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" id="name" placeholder="Confirm Password"
                        class="col-xs-12 col-md-11 col-sm-12" />
                    <br> <br>
                </div>
            </div>
           </div>
                <div class="form-group text-right" style="margin-right: 40px;">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-file-invoice-dollar"></i>Save</button>
                    </div> 
                </div>

                
            </div>
        </div>
    </div>
</form>

<div class="col-12 col-md-12 col-xs-12" style="margin-top: 20px;">
    <div class="widget-box">
        <div class="row" style="margin: 3px;">
            <div class="col-xs-12">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $user->name ?? 'Null' }}</td>
                                <td class="text-center">{{ $user->email ?? 'Null' }}</td>
                                <td class="text-center">
                                    @if ($user->image)
                                        <img src="{{ asset('image/user/' . $user->image) }}"
                                            alt="{{ $user->name }}" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('delete-form-{{ $user->id }}').submit();">
                                            <i style="color: red;" class="fa fa-trash"></i>
                                        </a>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>



<script>
$(document).ready(function() {
    $('#dynamic-table').DataTable();
});
</script>
<script>
$.noConflict();
jQuery(document).ready(function($) {
    $('#dynamic-table').DataTable();
});
</script>

<script>
window.onload = function() {
    var successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 3000);
    }
    var errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(function() {
            errorAlert.style.display = 'none';
        }, 3000);
    }
};
</script>
@endsection