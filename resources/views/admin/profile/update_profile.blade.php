@extends('admin.include.master')
@section('body')
<div style="background-image: radial-gradient(yellow 2%, yellow 5%, green 60%); width:100%;height:100px;">
    <h2 style="margin: 0; color: white; text-shadow: 2px 2px 4px #000000; padding: 20px 50px 0 100px;">Profile Information</h2>
    <h6 style="margin-top: 10px; padding: 0 50px 0 100px;">
        <ul class="breadcrumb" style="padding: 0; margin:0;">
            <li><a href="{{ route('dashboard') }}" style="color: white;">Dashboard</a></li>
            <li class="active" style="font-weight: bold;">Profile</li>
        </ul>
    </h6>
</div>
<div class="col-xs-12">
    <div class="hr dotted"></div>
    <div>
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger">{{session('failed')}}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="user-profile-1" class="user-profile row">
            <div class="col-xs-12 col-sm-3 center">
                <div>
                    <span class="profile-picture">
                        @if(Auth()->user()->image == null)
                            <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="{{ Avatar::create(Auth()->user()->name)->toBase64() }}" />
                        @else
                            <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="{{ asset('images/user/' . Auth()->user()->image) }}">
                        @endif
                    </span>
                    <div class="space-4"></div>
                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                        <div class="inline position-relative">
                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                <i class="ace-icon fa fa-circle light-green"></i>
                                &nbsp;
                                <span class="white">{{  Auth()->user()->name }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="space-6"></div>
                <div class="hr hr12 dotted"></div>
                <div class="hr hr16 dotted"></div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="space-12"></div>
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Name </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="username">{{Auth()->user()->name}}</span>
                        </div>
                    </div>
                    

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Email </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="username">{{Auth()->user()->email}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Phone </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="username">{{Auth()->user()->phone}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Joined </div>

                        <div class="profile-info-value">
                            <span class="editable editable-click" id="signup">{{Auth()->user()->created_at}}</span>
                        </div>
                    </div>
                </div>
                <div class="space-20"></div>
            </div>
        </div>
    </div>
    <h4 style="margin: 0px; margin-bottom:20px;">Edit Profile</h4>
    <div id="user-profile-3" class="user-profile row">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="form-horizontal">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-16">
                        <li class="active">
                            <a data-toggle="tab" href="#edit-basic" aria-expanded="true">
                                <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                                Basic Info
                            </a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#edit-password" aria-expanded="false">
                                <i class="blue ace-icon fa fa-key bigger-125"></i>
                                Password
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content profile-edit-tab-content">
                        <div id="edit-basic" class="tab-pane active">
                            <h4 class="header blue bolder smaller">General</h4>
                            <form action="{{route('info.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="image">Image :</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-5">
                                            <div class="widget-body">
                                                <div class="form-group">
                                                    <div class="col-xs-12 col-md-12">
                                                        <label class="ace-file-input ace-file-multiple">
                                                            <input type="file" name="image"
                                                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" /><span class="ace-file-container"
                                                                data-title="Choose Your Image..."><span class="ace-file-name"
                                                                    data-title="No File ..."><i
                                                                        class=" ace-icon ace-icon fa fa-cloud-upload"></i></span></span><a
                                                                class="remove" href="#"><i
                                                                    class=" ace-icon fa fa-times"></i></a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <span class="help-inline col-xs-12 col-sm-7">
                                            <label class="middle">
                                                <img height="145" id="blah" width="155" src="{{ asset('images/user/'.Auth()->user()->image) }}"
                                                    alt="Image">
                                            </label>
                                        </span>
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-username">Name</label>

                                    <div class="col-sm-9">
                                        <input class="col-xs-12 col-sm-10" name="name" type="text" id="form-field-username" placeholder="Name" value="{{Auth()->user()->name}}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email</label>

                                    <div class="col-sm-9">
                                        <input class="col-xs-12 col-sm-10" type="email" name="email" id="form-field-email" placeholder="Email" value="{{Auth()->user()->email}}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Phone</label>

                                    <div class="col-sm-9">
                                        <input name="phone" class="col-xs-12 col-sm-10" type="number" id="form-field-phone" value="{{Auth()->user()->phone}}" placeholder="Phone">
                                        @error('phone')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-info">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            save
                                        </button>
                
                                        &nbsp; &nbsp;
                                    </div>
                                </div>
                            </form>
                            <div class="space"></div>
                        </div>

                        <div id="edit-password" class="tab-pane">
                            <div class="space-10"></div>
                            <form action="{{route('profile.password.update')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Old Password</label>

                                <div class="col-sm-9">
                                    <input type="password" name="old_password" id="form-field-pass1">
                                </div>
                                @error('old_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Password</label>

                                <div class="col-sm-9">
                                    <input type="password" name="password" id="form-field-pass1">
                                </div>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm Password</label>

                                <div class="col-sm-9">
                                    <input type="password" name="password_confirmation" id="form-field-pass2">

                                    @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-info">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        save
                                    </button>
            
                                    &nbsp; &nbsp;
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

