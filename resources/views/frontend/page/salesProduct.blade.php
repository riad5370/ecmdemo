@extends('frontend.include.master')
@section('body')
    <!-- ======================= Top Breadcrubms ======================== -->
    <div class="gray py-3">
        <div class="container">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
               Discount Products
            </div>
          </div>
        </div>
      </div>
      
    <!-- ======================= Top Breadcrubms ======================== -->
    @if ($salesProduct->isEmpty())
     <div class="text-center text-danger" style="margin-bottom: 100px!important;margin-top: 100px!important;font-size:30px">This Category Product is Empty!</div>
    @else
    <section class="middle">
        <div class="container">
            <div class="row align-items-center rows-products">			
                <!-- Single -->
                @foreach($salesProduct as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0">
                            
                            @if($product->discount != null)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">{{$product->discount}}%</div>
                            @else
                                <div class="badge bg-info text-white position-absolute ft-regular ab-right text-upper">New</div>
                            @endif
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative"><a class="card-img-top d-block overflow-hidden" href="{{route('details',$product->slug)}}"><img class="card-img-top" width="" src="{{asset('images/products/preview/'.$product->preview)}}" alt="..."></a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                <div class="text-left">
                                    <div class="text-left">
                                        <div class="elso_titl"><span class="small">{{$product->category->name}}</span></div>
                                        <h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{route('details',$product->slug)}}">{{$product->name}}</a></h5>
                                        <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                            @php
                                                $star = App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->sum('star');
    
                                                $total_review = App\Models\OrderProduct::where('product_id',$product->id)->whereNotNull('review')->count();
    
                                                $avg_rating = 0;
                                                if($total_review != 0){
                                                    $avg_rating = round($star / $total_review);
                                                }
                                            @endphp
    
                                            @php
                                                for($x = 1; $x <= $avg_rating; $x++){
                                                    echo "<i class='fas fa-star filled'></i>";
                                                }
                                                for($l = $avg_rating +1; $l <= 5; $l++){
                                                    echo "<i class='fas fa-star'></i>";
                                                }
                                            @endphp
                                            
                                            
                                        </div>
                                        <div class="elis_rty">
                                            @if($product->discount != null)
                                                <span class="ft-medium text-muted line-through fs-md mr-2">BDT {{$product->price}}</span>
                                            @endif
                                            <span class="ft-bold text-dark fs-sm">BDT {{$product->after_discount}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $salesProduct->links() }}
            </div>
        </div>
    </section>
    @endif
    <!-- ======================= Customer Features ======================== -->
<section class="px-0 py-3 br-top">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Free Shipping</h5>
                        <span class="text-muted">Capped at $10 per order</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="far fa-credit-card"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">Secure Payments</h5>
                        <span class="text-muted">Up to 6 months installments</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">15-Days Returns</h5>
                        <span class="text-muted">Shop with fully confidence</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="d-flex align-items-center justify-content-start py-2">
                    <div class="d_ico">
                        <i class="fas fa-headphones-alt"></i>
                    </div>
                    <div class="d_capt">
                        <h5 class="mb-0">24x7 Fully Support</h5>
                        <span class="text-muted">Get friendly support</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Customer Features ======================== -->
@endsection
@push('js')
{{-- 12 --}}
@endpush
