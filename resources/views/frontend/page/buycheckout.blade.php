@extends('frontend.include.master')

@section('body')
<!-- ======================= Top Breadcrumbs ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrumbs ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('buynowcheckout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="size_id" value="{{ $size ? $size->id : '' }}">
                    <input type="hidden" name="color_id" value="{{ $color ? $color->id : '' }}">
                    <input type="hidden" name="quantity" value="{{$quantity}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="First Name" value="{{ Auth::guard('customerlogin')->user()->name }}" />
                                <input type="hidden" name="customer_id" class="form-control" value="{{ Auth::guard('customerlogin')->id() }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::guard('customerlogin')->user()->email }}" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Mobile Number *</label>
                                <input type="number" value="{{old('mobile')}}" name="mobile" class="form-control" placeholder="Mobile Number" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Address *</label>
                                <textarea name="address" class="form-control" placeholder="Address">{{old('address')}}</textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    {{-- <h5 class="mb-4">Order Items ({{ $total_item }})</h5> --}}
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="{{ asset('images/products/preview/' . $product->preview) }}" alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $product->name }}</h4>
                                        <p class="mb-1 lh-1">
                                            @if ($size)
                                            <span class="text-dark">{{ $size->name }}</span>
                                            @endif
                                        </p>
                                        <p class="mb-3 lh-1">
                                            @if ($color)
                                            <span class="text-dark">Color: {{ $color->name }}</span>
                                            @endif
                                        </p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">TK {{ $product->after_discount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="mb-4">
                    <div class="form-group">
                        <h6>Delivery Location</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c1" class="radio-custom delivery" name="charge" type="radio" value="70">
                                <label for="c1" class="radio-custom-label">Inside City</label>
                            </li>
                            <li>
                                <input id="c2" class="radio-custom delivery" name="charge" type="radio" value="150">
                                <label for="c2" class="radio-custom-label">Outside City</label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-group">
                        <h6>Select Payment Method</h6>
                        <ul class="no-ul-list">
                            <li>
                                <input id="c3" value="1" class="radio-custom" name="payment_method" checked type="radio">
                                <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                            </li>
                            {{-- <li>
                                <input id="c4" value="2" class="radio-custom" name="payment_method" type="radio">
                                <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                            </li>
                            <li>
                                <input id="c5" value="3" class="radio-custom" name="payment_method" type="radio">
                                <label for="c5" class="radio-custom-label">Pay With Stripe</label>
                            </li> --}}
                        </ul>
                    </div>
                </div>

                <div class="card mb-4 gray">
                    <div class="card-body">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Subtotal</span> 
                                <span class="ml-auto text-dark ft-medium" data_subtotal="{{ session('total') }}" id="sub_total">{{ number_format(session('total')) }}</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Charge</span> 
                                <span class="ml-auto text-dark ft-medium" id="charge">0</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                <span>Total</span> 
                                <span class="ml-auto text-dark ft-medium" id="grand_total">{{ number_format(session('total')) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <input type="hidden" value="{{ session('discount') }}" name="discount">
                <input type="hidden" value="{{ session('total') }}" name="sub_total">
                <button type="submit" class="btn btn-block btn-dark mb-3">Place Your Order</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ======================= Customer Features ======================== -->
@include('frontend.page.customer-feature')
<!-- ======================= Customer Features ======================== -->
@endsection
@push('js')
<script>
    $('.delivery').click(function() {
        var charge = $(this).val();
        var sub_total = $('#sub_total').attr('data_subtotal');
        var grand_total = parseInt(sub_total) + parseInt(charge);
        $('#charge').html(charge);
        $('#grand_total').html(grand_total.toLocaleString('en-US', {
            maximumFractionDigits: 2
        }));
    });
</script>
@endpush
