@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('content')
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Total Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-info">{{ count($orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Completed Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-success">{{ count($completed_orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Pending Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-primary">{{ count($pending_orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Cancelled Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-danger">{{ count($cancelled_orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Refunded Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-warning">{{ count($refunded_orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Failed Orders</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount text-danger">{{ count($failed_orders) }}</div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .nk-ecwg -->
            </div>
            <!-- .card -->
        </div>

        <!-- .col -->
    </div>
    <!-- .row -->
</div>

@endsection @section('script')
<script>

</script>
@endsection
@section('expiry_time')
	@if (isset($setting))
            
        <input type="hidden"  id="expiry_page_time" value="{{ $setting->expiry_time }}">
        @else
        <input type="hidden"  id="expiry_page_time" value="900000">
            
        @endif
@endsection