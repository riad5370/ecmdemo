<!-- Wishlist -->
<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
            <button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
        </div>
        <div class="right-ch-sideBar">
            <div class="cart_select_items py-2">
                <!-- Single Item -->
                @foreach (App\Models\Wishlish::where('customer_id',Auth::guard('customerlogin')->id())->get() as $wish)
                <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                    <div class="cart_single d-flex align-items-center">
                        <div class="cart_selected_single_thumb">
                            <a href="{{ route('details',$wish->product->slug) }}"><img src="{{ asset('images/products/preview/'.$wish->product->preview) }}" width="60" class="img-fluid" alt="" /></a>
                        </div>
                        <div class="cart_single_caption pl-2">
                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{ $wish->product->name }}</h4>
                            <h4 class=" mt-2 fs-md ft-medium mb-0 lh-1">{{ $wish->product->after_discount }}</h4>
                        </div>
                    </div>
                    <div class="fls_last"><a href="{{ route('wish.remove', $wish->id) }}" class="close_slide gray"><i class="ti-close"></i></a></div>
                </div>
                @endforeach
                
            </div>
            
            {{-- <div class="cart_action px-3 py-3">
                <div class="form-group">
                    <a href="{{ route('wishlist.view') }}" class="btn d-block full-width btn-dark-light">View Wishlist</a>
                </div>
            </div> --}}
            
        </div>
    </div>
</div>

<!-- Cart -->
<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
            <button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
        </div>
        <div class="right-ch-sideBar">
            
            <div class="cart_select_items py-2">
                <!-- Single Item -->
                @php
                    $subtotal = 0;
                @endphp
                @foreach (App\Models\cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart)
                        
                
                    <div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
                        <div class="cart_single d-flex align-items-center">
                            <div class="cart_selected_single_thumb">
                                <a href="{{ route('details',$cart->product->slug) }}"><img src="{{ asset('images/products/preview/'.$cart->product->preview) }}" width="60" class="img-fluid" alt="" /></a>
                            </div>
                            <div class="cart_single_caption pl-2">
                                <h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{ $cart->product->name }}</h4>
                                <p class="mb-2">Qty: <span class="text-dark ft-medium small">{{ $cart->quantity }}</span></p>
                                <h4 class="fs-md ft-medium mb-0 lh-1">{{ $cart->product->after_discount }}</h4>
                            </div>
                        </div>
                        <div class="fls_last"><a href="{{ route('cart.remove', $cart->id) }}" class="close_slide gray"><i class="ti-close"></i></a></div>
                    </div>
                    @php
                        $subtotal += $cart->product->after_discount*$cart->quantity;
                    @endphp
                @endforeach
            </div>
            
            <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                <h6 class="mb-0">Subtotal</h6>
                <h3 class="mb-0 ft-medium">TK {{ $subtotal }}</h3>
            </div>
            
            <div class="cart_action px-3 py-3">
                <div class="form-group">
                    <a href="{{ route('cart.view') }}" class="btn d-block full-width btn-dark-light">View Cart</a>
                </div>
            </div>
            
        </div>
    </div>
</div>

<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>