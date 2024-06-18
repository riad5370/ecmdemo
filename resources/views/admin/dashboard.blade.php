@extends('admin.include.master')
@push('css')
<style>
    .card {
        position: relative;
        padding: 20px;
        margin: 15px 0;
        border-radius: 10px;
        color: #fff;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .bg1 { background-color: #f39c12; }
    .bg2 { background-color: #00c0ef; }
    .bg3 { background-color: #00a65a; }
    .bg4 { background-color: #dd4b39; }
    .bg5 { background-color: #605ca8; }
    .bg6 { background-color: #f56954; }
    .title {
        font-size: 18px;
    }
    .number {
        font-size: 24px;
        font-weight: bold;
    }
    .link {
        color: #fff;
        text-decoration: underline;
    }
    .icon {
        font-size: 50px;
    }
    .icon-wrapper {
        text-align: right;
    }
    .content-wrapper {
        display: table;
        width: 100%;
    }
    .content {
        display: table-cell;
        vertical-align: middle;
    }



    

    .info-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.info-card-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.info-card-icon {
    font-size: 3em;
    margin-bottom: 15px;
}

.box1 .info-card-icon {
    color: #007bff;
}

.box2 .info-card-icon {
    color: #28a745;
}

.box3 .info-card-icon {
    color: #dc3545;
}

.box4 .info-card-icon {
    color: #ffc107;
}

.info-card-details .title {
    font-size: 1.2em;
    margin: 0;
    color: #333;
    font-weight: bold;
}

.info-card-details .number {
    font-size: 2.5em;
    margin: 10px 0;
}

.info-card-details .text {
    font-size: 1em;
    color: #6c757d;
    margin: 0;
}
</style>
@endpush
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card bg1">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Orders Pending!</div>
                            <div class="number">94</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-dollar icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card bg2">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Orders Processing!</div>
                            <div class="number">0</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-truck icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card bg3">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Orders Completed!</div>
                            <div class="number">5</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-check-circle icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card bg4">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Total Products!</div>
                            <div class="number">28</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-shopping-cart icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card bg5">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Total Customers!</div>
                            <div class="number">32</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-users icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card bg6">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="col-xs-9">
                            <div class="title">Total Posts!</div>
                            <div class="number">15</div>
                            <a href="" class="link">View All</a>
                        </div>
                        <div class="col-xs-3 icon-wrapper">
                            <i class="fa fa-newspaper-o icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- secrion 2 --}}
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="info-card box1">
                <div class="info-card-content">
                    <div class="info-card-icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="info-card-details">
                        <h6 class="title">New Customers</h6>
                        <p class="number">7</p>
                        <p class="text">Last 30 Days</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="info-card box2">
                <div class="info-card-content">
                    <div class="info-card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="info-card-details">
                        <h6 class="title">Total Customers</h6>
                        <p class="number">33</p>
                        <p class="text">All Time</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="info-card box3">
                <div class="info-card-content">
                    <div class="info-card-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="info-card-details">
                        <h6 class="title">Total Sales</h6>
                        <p class="number">0</p>
                        <p class="text">Last 30 Days</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="info-card box4">
                <div class="info-card-content">
                    <div class="info-card-icon">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <div class="info-card-details">
                        <h6 class="title">Total Sales</h6>
                        <p class="number">5</p>
                        <p class="text">All Time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection




