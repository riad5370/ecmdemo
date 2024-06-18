@extends('admin.include.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if(session('success'))
                <div class="alert alert-primary">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Coupon</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupons.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Coupon Name</label>
                            <input type="text"  name="name" class="form-control">
                            @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Discount%</label>
                            <input type="number"  name="discount" class="form-control">
                            @error('discount')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Expire Date</label>
                            <input type="date" name="expire" class="form-control">
                            @error('expire')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <select name="type" class="form-control">
                                <option value="">--select type--</option>
                                <option value="1">Percentage</option>
                                <option value="2">Solid Amount</option>
                            </select>
                            @error('type')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-success" value="Save"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection