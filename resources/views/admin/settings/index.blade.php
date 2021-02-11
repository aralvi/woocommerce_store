@extends('layouts.admin') @section('title','Setting') @section('page-title','Setting') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group mb-3">
                    <h4>
                        Update Setting
                    </h4>
                </div>
               
                <div class="row gy-4">
                    <form action="" method="post" class="col-sm-12">
                        @csrf
                        <div class="d-flex">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="mb-0">Select Store</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" id="stores" name="store" data-search="on">
                                            <option value="default_option">Choose store</option>
                                            @foreach ($shops as $shop)
                                            @if (Auth::user()->id == $shop->user_id)
                                                
                                            <option  class="text-capitalize" value="{{ $shop->id }}" {{ ($shop->id == $setting->shop_id) ? "selected":'' }}>{{ $shop->name }}</option>
                                            @endif
                                                
                                            @endforeach
                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="filter By Status" class="mb-0">Filter Status</label>
                                    <select id="order_status" name="order_status" class="form-control form-select" data-search="on">
                                        <option value="all" {{ 'all' == $setting->order_status ? "selected":'' }}>All</option>
                                        <option value="pending" {{ 'pending' == $setting->order_status ? "selected":'' }}>Pending payment</option>
                                        <option value="processing" {{ 'processing' == $setting->order_status ? "selected":'' }}>Processing</option>
                                        <option value="on-hold" {{ 'on-hold' == $setting->order_status ? "selected":'' }}>On hold</option>
                                        <option value="completed" {{ 'completed' == $setting->order_status ? "selected":'' }}>Completed</option>
                                        <option value="cancelled" {{ 'cancelled' == $setting->order_status ? "selected":'' }}>Cancelled</option>
                                        <option value="refunded" {{ 'refunded' == $setting->order_status ? "selected":'' }}>Refunded</option>
                                        <option value="failed" {{ 'failed' == $setting->order_status ? "selected":'' }}>Failed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="form-group mt-3 float-right">
                                <button class="btn btn-dim btn-primary ">Update Setting</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            <!-- .card-inner -->
        </div>
        <!-- .nk-ecwg -->
    </div>
    <!-- .card -->
</div>
@endsection
