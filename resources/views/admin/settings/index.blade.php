@extends('layouts.admin') @section('title','Setting') @section('page-title','Setting') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group mb-3">
                    <h3>
                        Update Setting
                    </h3>
                </div>
               
                <div class="row gy-4">
                    <form action="" method="post" class="col-sm-12">
                        <div class="d-flex">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="mb-0">Select Store</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" id="stores" name="store" data-search="on">
                                            <option value="default_option">Choose store</option>
                                            @foreach ($shops as $shop)
                                            @if (Auth::user()->id == $shop->user_id)
                                                
                                            <option  class="text-capitalize" value="{{ $shop->store_url }}" 
                                            data-key="{{ $shop->consumer_key }}"
                                            data-secret="{{ $shop->consumer_secret }}">{{ $shop->name }}</option>
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
                                        <option value="all" selected>All</option>
                                        <option value="pending">Pending payment</option>
                                        <option value="processing">Processing</option>
                                        <option value="on-hold">On hold</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                        <option value="failed">Failed</option>
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
