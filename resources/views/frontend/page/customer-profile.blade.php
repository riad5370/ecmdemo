@extends('frontend.include.master')
@section('body')
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-between">
            <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                <div class="d-block border rounded mfliud-bot">
                    <div class="dashboard_author px-2 py-5">
                        <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                            @auth('customerlogin')
                            @if(Auth::guard('customerlogin')->user()->photo == null)
                                <img width="100" src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" alt="">
                            @else
                                <img src="{{ asset('uploads/customer/'. Auth::guard('customerlogin')->user()->photo) }}" class="img-fluid circle" width="100" alt="" />
                            @endif
                            @endauth
                        </div>
                        <div class="dash_caption">
                            @auth('customerlogin')
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{ Auth::guard('customerlogin')->user()->name }}</h4>
                            <span class="text-muted smalls">{{ Auth::guard('customerlogin')->user()->country }}</span>
                            @endauth
                        </div>
                    </div>
                    
                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="{{ route('my.order') }}"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                            <li><a href="{{ route('customer.profile') }}" class="active"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="l{{ route('customer.logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                <!-- row -->
                <div class="row align-items-center">
                    <form class="row m-0" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                @auth('customerlogin')
                                <label class="small text-dark ft-medium">First Name *</label>
                                <input type="text" name="name" value="{{ Auth::guard('customerlogin')->user()->name }}" class="form-control" placeholder="Dhananjay" />
                                @endauth
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                @auth('customerlogin')
                                <label class="small text-dark ft-medium">Email ID *</label>
                                <input type="text" name="email" value="{{ Auth::guard('customerlogin')->user()->email }}" class="form-control" placeholder="dhananjay7@gmail.com" />
                                @endauth
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Current Password *</label>
                                <input type="password" name="old_password" class="form-control" placeholder="Current Password" />
                                @if (session('failled'))
                                    <strong class="text-danger">{{session('failled')}}</strong>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">New Password *</label>
                                <input type="password" name="password" class="form-control" placeholder="New Password" />
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Country" />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Mobile</label>
                                <input type="number" name="phone" class="form-control" placeholder="Mobile" />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Profile Image</label>
                                <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" /><br>
                                <img width="100" src="" id="blah" alt="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- row -->
            </div>
            
        </div>
    </div>
</section>
@endsection