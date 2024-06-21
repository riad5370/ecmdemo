@extends('frontend.include.master')
@section('body')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Login Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-center">
        
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="mb-3">
                    <h3>Login</h3>
                </div>
                @if(session('warning'))
                <div class="alert alert-warning">{{session('warning')}}</div>
                @endif
                @if(session('resetsucces'))
                <div class="alert alert-success">{{session('resetsucces')}}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-warning">{{session('error')}}</div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('msg'))
                <div class="alert alert-warning">{{session('msg')}}</div>
                @endif
                <form action="{{route('customer.login')}}" class="border p-3 rounded" method="POST">
                    @csrf				
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" placeholder="Email*">
                    </div>
                    
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="password" name="password" class="form-control" placeholder="Password*">
                    </div>
                    
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="eltio_k2">
                                <a href="{{route('forgot.password')}}">Lost Your Password?</a>
                            </div>	
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                    </div>

                    <div class="form-group d-flex justify-content-center">
                        <span>New member? <a href="{{route('customer.newregister')}}" class="text-decoration-none">Register here.</a></span>
                    </div>
                    <div class="my-4 text-center">
                        <a href="{{ route('google.redirect') }}" class="btn btn-danger btn-block d-flex justify-content-center align-items-center" style="width: 100%; max-width: 100%; text-align: center;">
                            <span>Login with google</span> 
                            <img style="width: 30px; margin-left: 10px;" src="{{ asset('frontend/img/google-plus.png') }}" alt="">
                        </a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Login End ======================== -->

<!-- ============================= Customer Features =============================== -->
@include('frontend.page.customer-feature')
<!-- ======================= Customer Features ======================== -->
@endsection