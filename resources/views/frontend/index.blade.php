@extends('frontend.include.master')
@section('body')
<!-- Category & Slider -->
<section class="p-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 hide-767-991">
                <!-- Sidebar for desktop -->
                <div class="killore-new-block-link border mb-3 mt-3 d-none d-md-block">
                    <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>
                    <div class="killore--block-link-content">
                        <ul>
                            @foreach($categories as $category)
                                <li style="font-family: fontawesome">
                                    <a href="{{ route('category.product', $category->id) }}">
                                        <i class="fas {{ $category->icon }}"></i> {{ $category->name }}
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
                            @foreach($sliders as $index => $slider)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($sliders as $index => $slider)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('images/sliders/' . $slider->image) }}" class="d-block w-100" alt="Slider Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category & Slider -->

<!-- All Category -->
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
                                    <img src="{{ asset('images/SubCategory/' . $category->image) }}" class="img-fluid" style="width: 40px;" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="sl_cat_02">
                            <h6 class="m-0 ft-medium fs-sm" style="font-size: 16px; color: #333; font-weight: 500;">
                                <a href="{{ route('subcategory.product', $category->id) }}" style="color: #333; text-decoration: none;">{{ $category->name }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- All Category -->

<!-- Product List -->
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
            <!-- Single Product -->
            @foreach ($products as $product)
            <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                <div class="product_grid card b-0">
                    @if($product->discount != null)
                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{ $product->discount }}%</div>
                    @else
                        <div class="badge bg-info text-white position-absolute ft-regular ab-right text-upper">New</div>
                    @endif

                    <div class="card-body p-0">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{ route('details', $product->slug) }}">
                                <img class="card-img-top" src="{{ asset('images/products/preview/' . $product->preview) }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                    </div>

                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                        <div class="text-left">
                            <div class="elso_titl">
                                <span class="small">
                                    @if($product->category != null)
                                        {{ $product->category->name }}
                                    @endif
                                </span>
                            </div>
                            <h5 class="fs-md mb-0 lh-1 mb-1">
                                <a href="{{ route('details', $product->slug) }}">{{ Str::limit($product->name, 43) }}</a>
                            </h5>
                            <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                @php
                                    $star = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->sum('star');
                                    $total_review = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->count();
                                    $avg_rating = $total_review != 0 ? round($star / $total_review) : 0;
                                @endphp

                                @for($x = 1; $x <= $avg_rating; $x++)
                                    <i class="fas fa-star filled"></i>
                                @endfor
                                @for($l = $avg_rating + 1; $l <= 5; $l++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <div class="elis_rty">
                                @if($product->discount != null)
                                    <span class="ft-medium text-muted line-through fs-md mr-2">BDT {{ $product->price }}</span>
                                @endif
                                <span class="ft-bold text-dark fs-sm">BDT {{ $product->after_discount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="row">
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
<!-- Product List -->

<!-- best selling Product List -->
@if ($best_selling_product && $best_selling_product->count() > 0)
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
            <!-- Single Product -->
            @foreach ($best_selling_product as $best_product)
                @if($best_product->product->category)
                <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                    <div class="product_grid card b-0">

                        @if($best_product->product->discount != null)
                            <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{ $best_product->product->discount }}%</div>
                        @else
                            <div class="badge bg-info text-white position-absolute ft-regular ab-right text-upper">New</div>
                        @endif

                        <div class="card-body p-0">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="{{ route('details', $best_product->product->slug) }}">
                                    <img class="card-img-top" src="{{ asset('images/products/preview/' . $best_product->product->preview) }}" alt="{{ $best_product->product->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                            <div class="text-left">
                                <div class="elso_titl">
                                    <span class="small">
                                        @if($best_product->product->category != null)
                                            {{ $best_product->product->category->name }}
                                        @endif
                                    </span>
                                </div>
                                <h5 class="fs-md mb-0 lh-1 mb-1">
                                    <a href="{{ route('details', $best_product->product->slug) }}">{{ Str::limit($best_product->product->name, 43) }}</a>
                                </h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    @php
                                        $star = App\Models\OrderProduct::where('product_id', $best_product->product_id)->whereNotNull('review')->sum('star');
                                        $total_review = App\Models\OrderProduct::where('product_id', $best_product->product_id)->whereNotNull('review')->count();
                                        $avg_rating = $total_review != 0 ? round($star / $total_review) : 0;
                                    @endphp

                                    @for($x = 1; $x <= $avg_rating; $x++)
                                        <i class="fas fa-star filled"></i>
                                    @endfor
                                    @for($l = $avg_rating + 1; $l <= 5; $l++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="elis_rty">
                                    @if($best_product->product->discount != null)
                                        <span class="ft-medium text-muted line-through fs-md mr-2">BDT {{ $best_product->product->price }}</span>
                                    @endif
                                    <span class="ft-bold text-dark fs-sm">BDT {{ $best_product->product->after_discount }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                @endif
            @endforeach
        </div>  
    </div>
</section>
@endif
<!-- best selling Product List-->

<!--Brand Start-->
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
<!--Customer Features-->
@include('frontend.page.customer-feature')
@endsection
