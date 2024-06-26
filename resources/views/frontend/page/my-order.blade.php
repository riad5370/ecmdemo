@extends('frontend.include.master')
@section('body')
    <!-- Top Breadcrubms -->
	<div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>		
    <!-- Top Breadcrubms -->
			
	<!--Dashboard Detail-->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">
                <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                    <div class="d-block border rounded">
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
                                <li><a href="{{route('my.order')}}" class="active"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                                <li><a href="{{ route('customer.profile') }}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                                <li><a href="{{ route('customer.logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                @if ($myorders->isEmpty())
                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <section class="middle">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">
                
                                    <!-- Icon -->
                                    <div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-success text-success mx-auto mb-4"><img width="100" src="https://static.thenounproject.com/png/237706-200.png" alt=""></div>
                                    <!-- Heading -->
                                    <h2 class="mb-5 ft-bold text-danger">No Products Order!</h2>
                                    <!-- Button -->
                                    <a class="btn btn-dark" href="{{ url('/') }}">Go To Shop</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                @else
                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <!-- Single Order List -->
                    @foreach ($myorders as $order)
                    <div class="ord_list_wrap border mb-4">
                        <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                            <div class="olh_flex">
                                <p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
                                <h6 class="mb-0 ft-medium">{{ $order->order_id }}</h6>
                            </div>

                            <div>
                                <a href="{{ route('download.invoice', $order->id) }}" class="bg-success text-white px-2 py-1">Download Invoice</a>
                            </div>
                            <div class="">
                                <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                                <div class="delv_status"><span class="ft-medium small badge bg-{{ 
                                    $order->status == 1 ? 'warning' : ($order->status == 2 ? 'info' : ($order->status == 3 ? 'primary' : ($order->status == 4 ? 'secondary' : ($order->status == 5 ? 'danger' : 'success')))) 
                                }} bg-light- rounded px-3 py-1">
                                    @php
                                    switch($order->status) {
                                        case 1: echo 'Placed'; break;
                                        case 2: echo 'Processing'; break;
                                        case 3: echo 'Packaging'; break;
                                        case 4: echo 'Ready to Deliver'; break;
                                        case 5: echo 'Shipped'; break;
                                        default: echo 'Delivered'; break;
                                    }
                                    @endphp
                                </span></div>
                            </div>
                        </div>
                        <div class="ord_list_body text-left">
                            @php $total = 0; @endphp
                            @foreach (App\Models\OrderProduct::where('order_id', $order->order_id)->get() as $order_product)
                            <!-- First Product -->
                            <div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="cart_single d-flex align-items-start mfliud-bot">
                                        <div class="cart_selected_single_thumb">
                                            <a href="#"><img src="{{ asset('uploads/product/preview/'.$order_product->product->preview) }}" width="75" class="img-fluid rounded" alt=""></a>
                                        </div>
                                        @php $category_id = $order_product->product->category_id; @endphp
                                        <div class="cart_single_caption pl-3">
                                            <p class="mb-0"><span class="text-muted small">{{ App\Models\Category::find($category_id)->name }}</span></p>
                                            <h4 class="product_title fs-sm ft-medium mb-1 lh-1">{{ $order_product->product->name }}</h4>
                                            <p class="mb-2">
                                                @if ($order_product->size)
                                                    <span class="text-dark medium">Size: {{ $order_product->size->name }}</span>,
                                                @endif
                                                @if ($order_product->color)
                                                    <span class="text-dark medium">Color: {{ $order_product->color->name }}</span>
                                                @endif
                                            </p>                                            
                                            <h4 class="fs-sm ft-bold mb-0 lh-1">{{ $order_product->price }} X {{ $order_product->quantity }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $total += $order_product->price * $order_product->quantity; @endphp
                            @endforeach
                        </div>
                        <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                                <div class="olf_flex_inner">
                                    <p class="m-0 p-0"><span class="text-muted medium text-left">Order Date: {{ $order->created_at->format('d-m-Y') }}</span></p>
                                </div>
                                <div class="olf_flex_inner">
                                    <p class="m-0 p-0"><span class="text-muted medium text-left">Discount: {{ $order->discount }}</span></p>
                                </div>
                                <div class="olf_flex_inner">
                                    <p class="m-0 p-0"><span class="text-muted medium text-left">Charge: {{ $order->charge }}</span></p>
                                </div>
                                <div class="olf_inner_right">
                                    <h5 class="mb-0 fs-sm ft-bold">Total: {{ ($total - $order->discount) + $order->charge }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section> 
@endsection