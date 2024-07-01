<!-- Top Header -->
<div class="py-2 br-bottom hide-above-1023">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
                <div class="top_second"><p class="medium text-muted m-0 p-0"><i class="lni lni-phone fs-sm"></i></i> Hotline <a href="#" class="medium text-dark text-underline">0(800) 123-456</a></p></div>
            </div>
            <!-- Right Menu -->
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                @auth('customerlogin')
				    <div class="dropdown show">
						<a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    {{ Auth::guard('customerlogin')->user()->name }}
						</a>
								
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="{{ route('customer.profile') }}">My Account</a>
							<a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>
						</div>
					</div>

				@else
					<div class="currency-selector dropdown js-dropdown float-right mr-3">
						<a href="{{ route('customer.signup') }}" class="text-muted medium"><i class="lni lni-user mr-1"></i>Sign In / Register</a>
					</div>
				@endauth
            </div>
            
        </div>
    </div>
</div>

<div class="headd-sty header sticky-top" style="background: #FF772D">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="headd-sty-wrap d-flex align-items-center justify-content-between py-3">
                    <div class="headd-sty-left d-flex align-items-center">
                        <div class="headd-sty-01">
                            <a class="nav-brand py-0" href="{{url('/')}}">
                                <img src="{{asset('frontend')}}/img/logo.png" class="logo" alt="" />
                            </a>
                        </div>
                        <div class="headd-sty-02 ml-3">
                            <div class="bg-white search-bar rounded-md border-bold" style="width: 530px;">
                                <div class="input-group">
                                    <input type="text" name="search_input" id="search_input" class="form-control custom-height b-0" value="{{ @$_GET['q'] }}" placeholder="Search for products..." />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><button id="search_btn" class="btn bg-white text-danger custom-height rounded px-3" type="submit"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            @media (max-width: 991px) and (min-width: 768px) {
                                .search-bar {
                                    width: 430px !important;
                                }
                            }
                            @media (max-width: 767px) and (min-width: 541px) {
                                .search-bar {
                                    width: 300px !important;
                                }
                            }
                            @media (max-width: 540px) {
                                .search-bar {
                                    width: auto !important;
                                }
                            }
                        </style> 
                    </div>
                    <div class="headd-sty-last">
                        <ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
                            <li>
                                <div class="">
                                    @auth('customerlogin')
                                        <div class="dropdown show">
                                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ Auth::guard('customerlogin')->user()->name }}
                                            </a>
                                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{ route('customer.profile') }}">My Account</a>
                                                <a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>
                                            </div>
                                        </div>
                    
                                    @else
                                        <div class="currency-selector dropdown js-dropdown float-right mr-3">
                                            <a href="{{ route('customer.signup') }}" class="text-muted medium"><i class="lni lni-user mr-1"></i>Sign In / Register</a>
                                        </div>
                                    @endauth
                                </div>
                            </li>
                            <li>
                                <a href="#" onclick="openCart()">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <i class="fas fa-shopping-basket fs-lg"></i><span class="dn-counter theme-bg">
                                            {{ App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count() }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        </ul>	
                    </div>
                    <div class="mobile_nav">
                        <ul>   
                            <li style="margin-left: 8px;">
                                <a href="#" onclick="openCart()">
                                    <i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $categories = App\Models\Category::all();
@endphp
<!-- Start Navigation -->
<div class="headerd header-dark head-style-2 hide-above-992 sticky-header">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <div class="nav-toggle"></div>
                <div class="nav-menus-wrapper">
                    <ul class="nav-menu">
                        @foreach($categories as $categori)
                        <li><a href="{{ route('category.product', $categori->id) }}">{{$categori->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
