@extends('frontend.include.master')
@push('css')
<style>
    .cats_side_wrap:hover {
        border: 1px solid #ff6f61 !important; 
        box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
        transform: translateY(-5px) !important;
    }

    @media (min-width: 1200px) {
        .col-xl-1-5 {
            flex: 0 0 12.5%;
            max-width: 12.5%;
        }
    }

    @media (min-width: 992px) and (max-width: 1199.98px) {
        .col-lg-1-5 {
            flex: 0 0 12.5%;
            max-width: 12.5%;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .col-md-2 {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
        }
    }

    @media (min-width: 576px) and (max-width: 767.98px) {
        .col-sm-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

    @media (max-width: 575.98px) {
        .col-3 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }
    }
</style>
@endpush
@section('body')
<!-- ======================= Category & Slider ======================== -->
<section class="p-0">
    <div class="container">
        <div class="row">
        
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 hide-767-991">
                <!-- Sidebar for desktop -->
                <div class="killore-new-block-link border mb-3 mt-3 d-none d-md-block">
                    <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>
                    <div class="killore--block-link-content">
                        <ul>
                            @foreach($categories as $categori)
                            <li style="font-family: fontawesome">
                                <a href="{{ route('category.product', $categori->id) }}">
                                    <i class="fas {{$categori->icon }}"></i>{{$categori->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="home-slider auto-slider mb-3 mt-3">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('frontend')}}/img/banner011.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('frontend')}}/img/banner022.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('frontend')}}/img/banner033.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Category & Slider ======================== -->

<!-- ======================= All Category ======================== -->
<section class="middle" style="background-color: #f0f4f8; padding: 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center" style="margin-bottom: 30px;">
                    <h3 class="ft-bold pt-3" style="font-size: 32px; color: #333; font-weight: 600;">Trending Categories</h3>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center justify-content-center">
            @foreach($subcategories as $category)
                <div class="col-xl-1-5 col-lg-1-5 col-md-2 col-sm-3 col-3" style="padding: 3px;">
                    <div class="cats_side_wrap text-center mx-auto" 
                        style="background: #fff; border-radius: 0px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;">
                        <div class="sl_cat_01" style="margin-bottom: 20px;">
                            <div class="d-inline-flex align-items-center justify-content-center circle" style="border-radius: 50%; width: 60px; height: 60px; background-color: #f7f7f7; margin: 0 auto; overflow: hidden;">
                                <a href="{{ route('subcategory.product', $category->id) }}" class="d-block">
                                    <img src="{{asset('images/SubCategory/'.$category->image)}}" class="img-fluid" style="width: 40px;" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="sl_cat_02">
                            <h6 class="m-0 ft-medium fs-sm" style="font-size: 16px; color: #333; font-weight: 500;">
                                <a href="{{ route('subcategory.product', $category->id) }}" style="color: #333; text-decoration: none;">{{$category->name}}</a>
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ======================= All Category ======================== -->


<!-- ======================= Product List ======================== -->
<section class="middle" style="margin-bottom: 0px; padding-bottom: 0px;">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative">
                    <h3 class="ft-bold pt-3">Our Trending Products</h3>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center rows-products">			
            <!-- Single -->
            @foreach ($products as $product)
            <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                <div class="product_grid card b-0">

                    @if($product->discount != null)
                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{$product->discount}}%</div>
                    @else
                        <div class="badge bg-info text-white position-absolute ft-regular ab-right text-upper">New</div>
                    @endif

                    <div class="card-body p-0">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{route('details',$product->slug)}}">
                                <img class="card-img-top" src="{{asset('images/products/preview/'.$product->preview)}}" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                        <div class="text-left">
                            <div class="text-left">
                                <div class="elso_titl">
                                    <span class="small">
                                        @if($product->category != null)
                                        {{$product->category->name}}
                                        @endif
                                    </span>
                                </div>
                                <h5 class="fs-md mb-0 lh-1 mb-1">
                                    <a href="shop-single-v1.html">{{$product->name}}</a>
                                </h5>
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
            {{$products->links()}} 
        </div>  
    </div>
</section>
<!-- ======================= Product List ======================== -->

<!-- =======================best selling Product List ======================== -->
<section class="middle" style="margin-top: 0px; padding-top: 0px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative">
                    <h3 class="ft-bold pt-3">Best Selling Products</h3>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center rows-products">			
            <!-- Single -->
            @foreach ($best_selling_product as $best_product)
            @if($best_product->product->category)
            <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                <div class="product_grid card b-0">

                    @if($best_product->product->discount != null)
                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{$best_product->product->discount}}%</div>
                    @else
                        <div class="badge bg-info text-white position-absolute ft-regular ab-right text-upper">New</div>
                    @endif

                    <div class="card-body p-0">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{route('details',$best_product->product->slug)}}">
                                <img class="card-img-top" src="{{asset('images/products/preview/'.$best_product->product->preview)}}" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                        <div class="text-left">
                            <div class="text-left">
                                <div class="elso_titl">
                                    <span class="small">
                                        @if($best_product->product->category != null)
                                        {{$best_product->product->category->name}}
                                        @endif
                                    </span>
                                </div>
                                <h5 class="fs-md mb-0 lh-1 mb-1">
                                    <a href="shop-single-v1.html">{{$best_product->product->name}}</a>
                                </h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    @php
                                    $star = App\Models\OrderProduct::where('product_id',$best_product->product_id)->whereNotNull('review')->sum('star');

                                    $total_review = App\Models\OrderProduct::where('product_id',$best_product->product_id)->whereNotNull('review')->count();

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
                                    @if($best_product->product->discount != null)
                                    <span class="ft-medium text-muted line-through fs-md mr-2">BDT {{$best_product->product->price}}</span>
                                    @endif
                                    <span class="ft-bold text-dark fs-sm">BDT {{$best_product->product->after_discount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            @endif
            @endforeach
            {{$products->links()}} 
        </div>  
    </div>
</section>
<!-- ======================= best selling Product List ======================== -->


<!-- ======================= Brand Start ============================ -->
<section class="py-3 br-top">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative ">
                    <h3 class="ft-bold pt-3">Products Brand</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="smart-brand">
                    @foreach ($brands as $brand)
                    <div class="single-brnads p-2">
                        <img src="{{asset('images/brand/'.$brand->image)}}" class="img-fluid" alt="" />
                    </div>
                    @endforeach
                </div>
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
    $(document).ready(function() {
      // Handle hover event for submenu on desktop
      $('.dropdown-submenu').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
      }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
      });
  
      // Optional: Handle click event for submenu on mobile
      $('.dropdown-submenu a').on("click", function(e) {
        var submenu = $(this).next('ul');
        if (submenu.length && $(window).width() < 768) {
          submenu.toggle();
          e.stopPropagation();
          e.preventDefault();
        }
      });
  
      // Hide submenus when clicking outside
      $(document).on("click", function(e) {
        if (!$(e.target).closest('.dropdown-submenu').length) {
          $('.dropdown-menu').hide();
        }
      });
    });
  </script>
@endpush