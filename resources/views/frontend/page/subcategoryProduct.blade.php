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
                            <li class="breadcrumb-item active" aria-current="page">Product by SubCategory:
                                <strong>{{ $sucategory_name->name }}</strong>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->
    @if ($subcategoryProducts->isEmpty())
    <section class="middle">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                    <!-- Icon -->
                    <div class="p-4 d-inline-flex align-items-center justify-content-center circle bg-light-success text-success mx-auto mb-4"><img width="100" src="https://static.thenounproject.com/png/237706-200.png" alt=""></div>
                    <!-- Heading -->
                    <h2 class="mb-5 ft-bold text-danger">No Products Found!</h2>
                    <!-- Button -->
                    <a class="btn btn-dark" href="{{ url('/') }}">Go To Shop</a>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="middle">
        <div class="container">
            <div class="row align-items-center rows-products">			
                <!-- Single -->
                @foreach($subcategoryProducts as $product)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-6">
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
                {{ $subcategoryProducts->links() }}
            </div>
        </div>
    </section>
    @endif
<!-- ======================= Customer Features ======================== -->
@include('frontend.page.customer-feature')
<!-- ======================= Customer Features ======================== -->
@endsection