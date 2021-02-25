@extends('layouts.admin')
@section('title','Orders')

@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Orders</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                                    class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                                        class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-group">
                                                <label for="" class="mb-0">Select Store</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select form-control form-control-lg" id="stores"
                                                        name="store" data-search="on">
                                                        <option value="default_option">Choose store</option>
                                                        @if (isset($shops))

                                                        @foreach ($shops as $shop)
                                                        @if (Auth::user()->id == $shop->user_id || Auth::user()->role
                                                        == 'SuperAdmin'
                                                        || Auth::user()->parent_id == $shop->user_id)

                                                        <option class="text-capitalize" value="{{ $shop->store_url }}"
                                                            data-key="{{ $shop->consumer_key }}"
                                                            data-secret="{{ $shop->consumer_secret }}"
                                                            {{ ($shop->id == $setting->shop_id) ? "selected":'' }}>
                                                            {{ $shop->name }}
                                                        </option>
                                                        @endif

                                                        @endforeach
                                                        @endif

                                                    </select>
                                                </div>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <label for="filter By Status" class="mb-0">Filter Status</label>
                                                <select id="order_status" name="order_status"
                                                    class="form-control form-select" data-search="on">
                                                    @if (isset($setting))

                                                    <option value="all"
                                                        {{ 'all' == $setting->order_status ? "selected":'' }}>All
                                                    </option>
                                                    <option value="pending"
                                                        {{ 'pending' == $setting->order_status ? "selected":'' }}>
                                                        Pending payment</option>
                                                    <option value="processing"
                                                        {{ 'processing' == $setting->order_status ? "selected":'' }}>
                                                        Processing</option>
                                                    <option value="on-hold"
                                                        {{ 'on-hold' == $setting->order_status ? "selected":'' }}>On
                                                        hold</option>
                                                    <option value="completed"
                                                        {{ 'completed' == $setting->order_status ? "selected":'' }}>
                                                        Completed</option>
                                                    <option value="cancelled"
                                                        {{ 'cancelled' == $setting->order_status ? "selected":'' }}>
                                                        Cancelled</option>
                                                    <option value="refunded"
                                                        {{ 'refunded' == $setting->order_status ? "selected":'' }}>
                                                        Refunded</option>
                                                    <option value="failed"
                                                        {{ 'failed' == $setting->order_status ? "selected":'' }}>
                                                        Failed</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt pb-0">
                                            {{-- <div class="btn-group"> --}}
                                            <button class="btn btn-md btn-dim btn-primary order_status mt-3"
                                                onclick="getOrderList();" data-toggle="modal"
                                                data-target="#modalForm">Change Order Status </button>
                                            {{-- </div> --}}
                                        </li>
                                        <li class="nk-block-tools-opt pb-0">
                                            <form action="{{ route('fetch.orders') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="store_url"  value="{{ $store_url }}" id="fetch_store_url">
                                                <input type="hidden" name="consumer_key" value="{{ $consumer_key }}"  id="fetch_consumer_key">
                                                <input type="hidden" name="consumer_secret" value="{{ $consumer_secret }}"  id="fetch_consumer_secret">
                                                <button type="submit" class="btn btn-dim btn-primary mt-3">Fetch Orders</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div id="orders_table">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary d-none" id="loading" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                        <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer" data-auto-responsive="false">
                            <thead class="thead-dark">
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid1">
                                            <label class="custom-control-label" for="uid1"></label>
                                        </div>
                                        {{-- <input type="checkbox" name="" class=" " id="orders_check"> --}}
                                    </th>
                                    <th class="nk-tb-col">Order# </th>
                                    <th class="nk-tb-col">Customer </th>
                                    <th class="nk-tb-col tb-col-mb">Status</th>
                                    <th class="nk-tb-col tb-col-md">Date</th>
                                    <th class="nk-tb-col tb-col-lg">Total</th>
                                    <th class="nk-tb-col tb-col-md">Items</th>
                                    {{-- <th class="nk-tb-col tb-col-md">Curior</th> --}}
                                    <th class="nk-tb-col tb-col-md">Action</th>

                                </tr>
                            </thead>
                            <tbody id="order_table">
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $count=> $order)
                                        @php
                                            $consignment = App\Consignment::where('order_id',$order->id)->first();
                                        @endphp

                                        @if ( $setting->order_status == 'all')
                                            @php
                                                if (isset($setting->excluded_Status)) {
                                                $excluded_statuses = json_decode($setting->excluded_Status);
                                                }
                                                @endphp
                                            @if (isset($excluded_statuses))
                                                @foreach ($excluded_statuses as $excluded_statuse)
                                                    @if ($excluded_statuse != $order->status)
                                                        <tr class="nk-tb-item">
                                                            <td>hello</td>
                                                            <td class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input order_check" id="uid{{ $count+2 }}"
                                                                        value="{{ $order->id }}">
                                                                    <label class="custom-control-label order_check" for="uid{{ $count+2}}"></label>
                                                                </div>
                                                                {{-- <input type="checkbox" name="" class="order_check " value="{{ $order->id }}"> --}}
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-info">
                                                                    <a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-info">
                                                                    <a href="{{ route('orders.show',$order->id) }}">{{ $order->customer }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-mb">
                                                                @if ($order->status == 'on-hold')
                                                                <span class="dot bg-warning d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'completed')
                                                                <span class="dot bg-success d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'failed')
                                                                <span class="dot bg-danger d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'pending')
                                                                <span class="dot bg-info d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-info d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'processing')
                                                                <span class="dot bg-primary d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-primary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'refunded')
                                                                <span class="dot bg-secondary d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-secondary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'cancelled')
                                                                <span class="dot bg-danger d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                {{-- <span class="tb-amount">{{ $order->status }}</span> --}}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <span>{{$order->date}}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                                {{ $order->total }}
                                                            </td>

                                                            <td class="nk-tb-col tb-col-lg">
                                                                {{ $order->items }}
                                                            </td>

                                                            <td class="nk-tb-col tb-col-md">

                                                                {{-- <a href="{{ route('orders.show',$order->id) }}"
                                                                class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                                                {{-- <ul class="nk-tb-actions gx-1"> --}}
                                                                <li class="nk-tb-action-hidden list-unstyled d-flex">
                                                                    <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}"
                                                                        class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                                                                        data-original-title="view at Woocommerce">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    <div class="drodown mr-n1">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                                                class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li>
                                                                                    <a href="{{ route('orders.show',$order->id) }}">
                                                                                        <em class="icon ni ni-eye"></em>
                                                                                        <span>Order Details</span>
                                                                                    </a>
                                                                                </li>

                                                                                @if(!$consignment && $order->tracking_link ==null && $order->tracking_link ==null)

                                                                                   <li>
                                                                                        <a href="{{ route('add.consignment',$order->id) }}">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Add Consignment</span>
                                                                                        </a>
                                                                                    </li>

                                                                                @endif

                                                                                @if($consignment)

                                                                                    <li>
                                                                                        <a type="button" data-toggle="modal"
                                                                                            onclick="orderSetting(this,{{ $order->id }},'{{ $consignment->label_number }}');"
                                                                                            data-target="#addTrackingInfo">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Add Tracking</span>
                                                                                        </a>
                                                                                    </li>

                                                                                @endif

                                                                                
                                                                                @if($order->tracking_link !=null)
                                                                                    <li>
                                                                                        <a href="{{ $order->tracking_link }}" target="_blank">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Order Tracking</span>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                                
                                                                                   
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>


                                                            </td>

                                                        </tr><!-- .nk-tb-item  -->
                                                    @endif
                                                @endforeach

                                            @else
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input order_check" id="uid{{ $count+2 }}"
                                                                value="{{ $order->id }}">
                                                            <label class="custom-control-label order_check" for="uid{{ $count+2}}"></label>
                                                        </div>
                                                        {{-- <input type="checkbox" name="" class="order_check " value="{{ $order->id }}"> --}}
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-info">
                                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-info">
                                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->customer }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb">
                                                        @if ($order->status == 'on-hold')
                                                        <span class="dot bg-warning d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'completed')
                                                        <span class="dot bg-success d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'failed')
                                                        <span class="dot bg-danger d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'pending')
                                                        <span class="dot bg-info d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-info d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'processing')
                                                        <span class="dot bg-primary d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-primary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'refunded')
                                                        <span class="dot bg-secondary d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-secondary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'cancelled')
                                                        <span class="dot bg-danger d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        {{-- <span class="tb-amount">{{ $order->status }}</span> --}}
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span>{{$order->date}}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                        {{ $order->total }}
                                                    </td>

                                                    <td class="nk-tb-col tb-col-lg">
                                                        {{ $order->items }}
                                                    </td>

                                                    <td class="nk-tb-col tb-col-md">

                                                        {{-- <a href="{{ route('orders.show',$order->id) }}"
                                                        class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                                        {{-- <ul class="nk-tb-actions gx-1"> --}}
                                                        <li class="nk-tb-action-hidden list-unstyled d-flex">
                                                            <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                                                                data-original-title="view at Woocommerce">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            <div class="drodown mr-n1">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="{{ route('orders.show',$order->id) }}">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>Order Details</span>
                                                                            </a>
                                                                        </li>

                                                                        @if(!$consignment && $order->tracking_link ==null)

                                                                           <li>
                                                                                <a href="{{ route('add.consignment',$order->id) }}">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Add Consignment</span>
                                                                                </a>
                                                                            </li>

                                                                        @endif

                                                                        @if($consignment && $order->tracking_link == null)

                                                                            <li>
                                                                                <a type="button" data-toggle="modal"
                                                                                    onclick="orderSetting(this,{{ $order->id }},'{{ $consignment->label_number }}');"
                                                                                    data-target="#addTrackingInfo">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Add Tracking</span>
                                                                                </a>
                                                                            </li>

                                                                        @endif

                                                                        
                                                                        @if($order->tracking_link !=null)
                                                                            <li>
                                                                                <a href="{{ $order->tracking_link }}" target="_blank">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Order Tracking</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                            
                                                    </td>
                                                    

                                                </tr><!-- .nk-tb-item  -->
                                            @endif

                                        @else
                                            @if ($order->status == $setting->order_status)
                                                @if (isset($excluded_statuses))
                                                    @foreach ($excluded_statuses as $excluded_statuse)
                                                        @if ($excluded_statuse != $order->status)
                                                        <tr class="nk-tb-item">
                                                            <td class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input order_check" id="uid{{ $count+2 }}"
                                                                        value="{{ $order->id }}">
                                                                    <label class="custom-control-label order_check" for="uid{{ $count+2}}"></label>
                                                                </div>
                                                                {{-- <input type="checkbox" name="" class="order_check " value="{{ $order->id }}"> --}}
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-info">
                                                                    <a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-info">
                                                                    <a href="{{ route('orders.show',$order->id) }}">{{ $order->customer }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-mb">
                                                                @if ($order->status == 'on-hold')
                                                                <span class="dot bg-warning d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'completed')
                                                                <span class="dot bg-success d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'failed')
                                                                <span class="dot bg-danger d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'pending')
                                                                <span class="dot bg-info d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-info d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'processing')
                                                                <span class="dot bg-primary d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-primary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'refunded')
                                                                <span class="dot bg-secondary d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-secondary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                @if ($order->status == 'cancelled')
                                                                <span class="dot bg-danger d-mb-none"></span>
                                                                <span
                                                                    class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                                @endif
                                                                {{-- <span class="tb-amount">{{ $order->status }}</span> --}}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <span>{{$order->date}}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                                {{ $order->total }}
                                                            </td>

                                                            <td class="nk-tb-col tb-col-lg">
                                                                {{ $order->items }}
                                                            </td>

                                                            <td class="nk-tb-col tb-col-md">

                                                                {{-- <a href="{{ route('orders.show',$order->id) }}"
                                                                class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                                                {{-- <ul class="nk-tb-actions gx-1"> --}}
                                                                <li class="nk-tb-action-hidden list-unstyled d-flex">
                                                                    <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}"
                                                                        class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                                                                        data-original-title="view at Woocommerce">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    <div class="drodown mr-n1">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                                                class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li>
                                                                                    <a href="{{ route('orders.show',$order->id) }}">
                                                                                        <em class="icon ni ni-eye"></em>
                                                                                        <span>Order Details</span>
                                                                                    </a>
                                                                                </li>

                                                                                @if(!$consignment && $order->tracking_link ==null)

                                                                                   <li>
                                                                                        <a href="{{ route('add.consignment',$order->id) }}">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Add Consignment</span>
                                                                                        </a>
                                                                                    </li>

                                                                                @endif

                                                                                @if($consignment && $order->tracking_link == null)

                                                                                    <li>
                                                                                        <a type="button" data-toggle="modal"
                                                                                            onclick="orderSetting(this,{{ $order->id }},'{{ $consignment->label_number }}');"
                                                                                            data-target="#addTrackingInfo">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Add Tracking</span>
                                                                                        </a>
                                                                                    </li>

                                                                                @endif

                                                                                
                                                                                @if($order->tracking_link !=null)
                                                                                    <li>
                                                                                        <a href="{{ $order->tracking_link }}" target="_blank">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Order Tracking</span>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                                   

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>


                                                            </td>

                                                        </tr><!-- .nk-tb-item  -->
                                                        @endif

                                                    @endforeach
                                                @else
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input order_check" id="uid{{ $count+2 }}"
                                                                value="{{ $order->id }}">
                                                            <label class="custom-control-label order_check" for="uid{{ $count+2}}"></label>
                                                        </div>
                                                        {{-- <input type="checkbox" name="" class="order_check " value="{{ $order->id }}"> --}}
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-info">
                                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <div class="user-info">
                                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->customer }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-mb">
                                                        @if ($order->status == 'on-hold')
                                                        <span class="dot bg-warning d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-warning d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'completed')
                                                        <span class="dot bg-success d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-success d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'failed')
                                                        <span class="dot bg-danger d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'pending')
                                                        <span class="dot bg-info d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-info d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'processing')
                                                        <span class="dot bg-primary d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-primary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'refunded')
                                                        <span class="dot bg-secondary d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-secondary d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        @if ($order->status == 'cancelled')
                                                        <span class="dot bg-danger d-mb-none"></span>
                                                        <span
                                                            class="badge badge-sm badge-dot has-bg badge-danger d-none d-mb-inline-flex">{{ $order->status }}</span>
                                                        @endif
                                                        {{-- <span class="tb-amount">{{ $order->status }}</span> --}}
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span>{{$order->date}}</span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                        {{ $order->total }}
                                                    </td>

                                                    <td class="nk-tb-col tb-col-lg">
                                                        {{ $order->items }}
                                                    </td>

                                                    <td class="nk-tb-col tb-col-md">

                                                        {{-- <a href="{{ route('orders.show',$order->id) }}"
                                                        class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                                        {{-- <ul class="nk-tb-actions gx-1"> --}}
                                                        <li class="nk-tb-action-hidden list-unstyled d-flex">
                                                            <a href="{{ $store_url."/wp-admin/post.php?post=".$order->id."&action=edit " }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title=""
                                                                data-original-title="view at Woocommerce">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            <div class="drodown mr-n1">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a href="{{ route('orders.show',$order->id) }}">
                                                                                <em class="icon ni ni-eye"></em>
                                                                                <span>Order Details</span>
                                                                            </a>
                                                                        </li>

                                                                        @if(!$consignment && $order->tracking_link ==null)

                                                                           <li>
                                                                                <a href="{{ route('add.consignment',$order->id) }}">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Add Consignment</span>
                                                                                </a>
                                                                            </li>

                                                                        @endif

                                                                        @if($consignment && $order->tracking_link == null)

                                                                            <li>
                                                                                <a type="button" data-toggle="modal"
                                                                                    onclick="orderSetting(this,{{ $order->id }},'{{ $consignment->label_number }}');"
                                                                                    data-target="#addTrackingInfo">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Add Tracking</span>
                                                                                </a>
                                                                            </li>

                                                                        @endif

                                                                        
                                                                        @if($order->tracking_link !=null)
                                                                            <li>
                                                                                <a href="{{ $order->tracking_link }}" target="_blank">
                                                                                    <em class="icon ni ni-eye"></em>
                                                                                    <span>Order Tracking</span>
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                           

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                        
                                                            
                                                            


                                                    </td>

                                                </tr><!-- .nk-tb-item  -->
                                                @endif


                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
</div>
</div>
<!-- .card-inner -->
</div>
<!-- .nk-ecwg -->
</div>
<!-- .card -->
</div>

{{-- Add modal --}}

<div class="modal fade zoom" tabindex="-1" id="addTrackingInfo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Tracking Info</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body">
                <form action="" method="POST" id="addTrackingInfoForm">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id_for_tracking" value="">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Provider</label>
                                <select name="provider" class="form-control form-select" data-search="on" required>
                                    <option value="fastway-au">Fastway</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="tracking_number">Tracking Number</label>
                                <div class="form-control-wrap"><input type="text" name="tracking_number"
                                        class="form-control" id="tracking_number" required="" /></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">

                                <div class="form-control-wrap focused">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-calendar-alt"></em>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-xl form-control-outlined date-picker"
                                        name="shipping_date" id="outlined-date-picker" required="">
                                    <label class="form-label-outlined" for="outlined-date-picker">Shipping Date</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Add
                                    Tracking</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div> {{-- Add Tracking Info Modal --}}

<div class="modal fade zoom" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Status</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('order.changestatus') }}" id="orderStatus" class="form-validate is-alter"
                method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="filter By Status" class="mb-0">Order Stataus</label>
                        @php
                        if(isset($setting->change_able_Status)){

                        $change_able_statuses = json_decode($setting->change_able_Status);
                        }
                        @endphp
                        <select id="change_order_status" name="order_status" class="form-control form-select"
                            data-search="on">
                            @if(isset($change_able_statuses))
                            @foreach ( $change_able_statuses as $change_able_status)
                            <option value="{{ $change_able_status }}">{{ $change_able_status }}</option>
                            @endforeach
                            @else
                            <option disabled selected>Choose Status</option>
                            <option value="pending">Pending payment</option>
                            <option value="processing">Processing</option>
                            <option value="on-hold">On hold</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="refunded">Refunded</option>
                            <option value="failed">Failed</option>
                            @endif
                        </select>
                        <label id='lblStatus' style="display: none;"></label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary" id="update_Status">Save
                            Informations</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="OrderNoteModalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Order Note</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('ordernotes.store') }}" class="form-validate is-alter" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="ordernote">Order Note</label>
                        <div class="form-control-wrap">
                            <input type="hidden" name="order_id" value="" id="order_id">
                            <input type="text" class="form-control" name="order_note" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    function orderSetting(elem, id,tracking_number)
    {
        // var c_url = '{{ route("add.tracking.info", ":id") }}';
        // c_url = c_url.replace(':id',id);
        $('#addTrackingInfoForm').attr('action', '{{ route("add.tracking.info")}}');
        $('#order_id_for_tracking').val(id);
        $('#tracking_number').val(tracking_number);
    }

    function getOrderList() {
        $('#orderStatus').find('#appended_section').remove();
        var cars = [];
        $.each($('.order_check'), function () {
            if ($(this).is(':checked')) {
                cars.push($(this).val());

            }
        });
        var key = $('.consumer_key').val();
        var store_url = $('.store_url').val();
        var secret = $('.consumer_secret').val();
        let ht = '<div id="appended_section"></div><input type="hidden" id="order_list" name="order_list" value="' +
            cars + '"/><input type="hidden" id="key" name="key" value="' + key +
            '"/><input type="hidden" id="store_url" name="store_url" value="' + store_url +
            '"/><input type="hidden" id="secret" name="secret" value="' + secret + '"/></div>';
        $('#orderStatus').append(ht);
    }
    $('#update_Status').on('click', function () {
        if ($('#order_list').val() == '') {
            $('#lblStatus').html('Please check Atleast one order ').css({
                'display': 'block',
                'color': 'red'
            });
            return false
        } else {
            $('#lblStatus').css({
                'display': 'none'
            });
        }
        if ($('#change_order_status').val() == null) {
            $('#lblStatus').html('Please select  atleast one option ').css({
                'display': 'block',
                'color': 'red'
            });
            return false
        } else {
            $('#lblStatus').css({
                'display': 'none'
            });
        }
    })
    $("#uid1").click(function () {
        var cars = [];
        if ($(this).is(':checked')) {
            $('.order_check').attr('checked', 'checked');
            $.each($('.order_check'), function () {
                if ($(this).is(':checked')) {
                    cars.push($(this).val());

                }

            });
        } else {
            $('.order_check').removeAttr('checked', 'checked');

        }
    });
    $("#order_status").on('change', function () {
        var status = $(this).val();
        var key = $('.consumer_key').val();
        var store_url = $('.store_url').val();
        var secret = $('.consumer_secret').val();
        $('#loading').removeClass('d-none');
        $.ajax({
            type: 'post',
            url: "{{ route('order.status')}}",
            data: {
                key: key,
                store_url: store_url,
                secret: secret,
                status: status,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                $('#orders_table').empty();
                $('#orders_table').html(data);
            }
        });

    });


    $('#search_order').on('input', function (e) {
        var query = $(this).val();
        $.ajax({
            type: "post",
            url: "{{ route('order.search')}}",
            data: {
                query: query,
                _token: "{{ csrf_token() }}"
            },

            success: function (data) {
                $('#order_table').empty();
                $('#order_table').html(data);


            },
        });

    });

    $('#stores').on('change', function (e) {
        var store_url = $(this).val();
        var key = $(this).children("option:selected").attr('data-key');
        var secret = $(this).children("option:selected").attr('data-secret');
        $('#fetch_store_url').val(store_url);
        $('#fetch_consumer_key').val(key);
        $('#fetch_consumer_secret').val(secret);
        $('#loading').removeClass('d-none');
        $.ajax({
            type: "post",
            url: "{{ route('order.store')}}",
            data: {
                store_url: store_url,
                key: key,
                secret: secret,
                _token: "{{ csrf_token() }}"
            },

            success: function (data) {
                $('#orders_table').empty();
                $('#orders_check').removeAttr('checked');
                $('#orders_table').html(data);



            },
        });

    });


    $(document).keyup(function (event) {
        if (event.which === 13) {
            let id = $('.dataTables_filter label input').val();
            if (id != '') {
                var c_url = '{{ route("orders.show", ":id") }}';
                c_url = c_url.replace(':id', id);
                $.ajax({
                    url: "{{ route('single.order.detail')}}",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data == "exist") {
                            $('.invalidOrderIdError').html('');
                            window.open(c_url);
                            // window.location = c_url;
                        }
                    },
                    error: function (request) {
                        let html =
                            '<div class="alert alert-danger alert-block" role="alert"><button type="button" class="close" data-dismiss="alert">×</button><strong>Invalid Order ID</strong></div>';
                        $('.invalidOrderIdError').html(html);
                    }
                });
            } else {
                alert("empty");
            }
        }
    });

</script>
@endsection
