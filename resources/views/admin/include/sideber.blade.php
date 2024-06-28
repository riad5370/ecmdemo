<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script> 
    <ul class="nav nav-list">
        <li class="@if(Request::segment(1) == 'dashboard' ) active @endif">
            <a href="{{ route('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>
        
        {{-- product section --}}
        <li class="@if(in_array(Request::segment(1), ['products', 'categories', 'subcategories', 'brands','product'])) active open @endif">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-archive"></i>
                <span class="menu-text">
                    Product Area
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            
            <ul class="submenu">
                <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{route('products.index')}}">
                        Product List
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <a href="{{route('products.create')}}">
                        Add Product
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}">
                        Category
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('subcategories.index') ? 'active' : '' }}">
                    <a href="{{route('subcategories.index')}}">
                        Sub Category
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('brands.index') ? 'active' : '' }}">
                    <a href="{{route('brands.index')}}">
                        Brand
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('products.variation') ? 'active' : '' }}">
                    <a href="{{route('products.variation')}}">
                        Products Variation
                    </a>
                </li>
            </ul>
        </li>

        {{-- customer section --}}
        <li class="@if(in_array(Request::segment(1), ['coupons'])) active open @endif">
            <a href="{{route('coupons.index')}}">
                <i class="menu-icon fa fa-tags"></i>
                <span class="menu-text">
                    Cuopons
                </span>
            </a>
        </li>
        
        {{-- order section --}}
        <li class="@if(in_array(Request::segment(1), ['orders'])) active open @endif">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-shopping-cart"></i>
                <span class="menu-text">
                    Orders
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            
            <ul class="submenu">
                <li class="{{ request()->routeIs('orders') ? 'active' : '' }}">
                    <a href="{{route('orders')}}">
                        All Orders
                    </a>
                </li>
            </ul>

            <ul class="submenu">
                <li class="{{ request()->routeIs('pending.orders') ? 'active' : '' }}">
                    <a href="{{route('pending.orders')}}">
                        Pending Orders
                    </a>
                </li>
            </ul>

            <ul class="submenu">
                <li class="{{ request()->routeIs('complete.orders') ? 'active' : '' }}">
                    <a href="{{route('complete.orders')}}">
                        Complete Orders
                    </a>
                </li>
            </ul>
        </li>

        {{-- customer section --}}
        <li class="@if(in_array(Request::segment(1), ['cutomer-list','billing-customer'])) active open @endif">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text">
                    Customers
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            
            <ul class="submenu">
                <li class="{{ request()->routeIs('customers.list') ? 'active' : '' }}">
                    <a href="{{route('customers.list')}}">
                        Sign Up
                    </a>
                </li>
            </ul>
            <ul class="submenu">
                <li class="{{ request()->routeIs('billing.customers') ? 'active' : '' }}">
                    <a href="{{route('billing.customers')}}">
                        Billing
                    </a>
                </li>
            </ul>
        </li>

        {{-- sliders section --}}
        <li class="@if(in_array(Request::segment(1), ['sliders'])) active open @endif">
            <a href="{{route('sliders.index')}}">
                <i class="menu-icon fa fa-sliders"></i>
                <span class="menu-text">
                    Slider
                </span>
            </a>
        </li>

        {{-- customer section --}}
        <li class="@if(in_array(Request::segment(1), ['users'])) active open @endif">
            <a href="{{route('users.index')}}">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">
                    User
                </span>
            </a>
        </li>
        
       
    </ul>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>






