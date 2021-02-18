@extends('layouts.admin')
@section('title','Orders')
@section('page-title','Order Lists')
@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="mb-0">Select Store</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" id="stores" name="store"
                                        data-search="on">
                                        <option value="default_option">Choose store</option>
                                        @if (isset($shops))

                                        @foreach ($shops as $shop)
                                        @if ((Auth::user()->id == $shop->user_id) || Auth::user()->role == 'SuperAdmin'
                                        || Auth::user()->parent_id == $shop->user_id)

                                        <option class="text-capitalize" value="{{ $shop->store_url }}"
                                            data-key="{{ $shop->consumer_key }}"
                                            data-secret="{{ $shop->consumer_secret }}"
                                            {{ ($shop->id == $setting->shop_id) ? "selected":'' }}>{{ $shop->name }}
                                        </option>
                                        @endif

                                        @endforeach
                                        @endif

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- <div class="form-group">
                                <label for="" class="mb-0">Select curior Service</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on">
                                        <option value="default_option">Choose Curier service</option>
                                        <option value="option_select_name">TCS</option>
                                        <option value="option_select_name">Lepord</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-2">
                            {{-- <div class="form-group">
                                <label for="filter By Status" class="mb-0">Search</label>
                                <input class="mu-input-box form-control" name="order_search" id="search_order"
                                    type="text" placeholder="search order status" />
                            </div> --}}
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-end">
                            <div class="btn-group">
                                <button class="btn btn-md btn-dim btn-primary order_status" onclick="getOrderList();"
                                    data-toggle="modal" data-target="#modalForm">Change Order Status </button>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="filter By Status" class="mb-0">Filter Status</label>
                                <select id="order_status" name="order_status" class="form-control form-select"
                                    data-search="on">
                                    @if (isset($setting))

                                    <option value="all" {{ 'all' == $setting->order_status ? "selected":'' }}>All
                                    </option>
                                    <option value="pending" {{ 'pending' == $setting->order_status ? "selected":'' }}>
                                        Pending payment</option>
                                    <option value="processing"
                                        {{ 'processing' == $setting->order_status ? "selected":'' }}>Processing</option>
                                    <option value="on-hold" {{ 'on-hold' == $setting->order_status ? "selected":'' }}>On
                                        hold</option>
                                    <option value="completed"
                                        {{ 'completed' == $setting->order_status ? "selected":'' }}>Completed</option>
                                    <option value="cancelled"
                                        {{ 'cancelled' == $setting->order_status ? "selected":'' }}>Cancelled</option>
                                    <option value="refunded" {{ 'refunded' == $setting->order_status ? "selected":'' }}>
                                        Refunded</option>
                                    <option value="failed" {{ 'failed' == $setting->order_status ? "selected":'' }}>
                                        Failed</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="orders_table">
                        <div class="spinner-border text-secondary d-none" id="loading" role="status">
                            <span class="sr-only">

                            </span>
                        </div>
                        <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer"
                            data-auto-responsive="false">
                            <thead class="thead-dark">
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <input type="checkbox" name="" class=" " id="orders_check">
                                    </th>
                                    <th class="nk-tb-col">Order# </th>
                                    <th class="nk-tb-col">Customer </th>
                                    <th class="nk-tb-col tb-col-mb">Status</th>
                                    <th class="nk-tb-col tb-col-md">Date</th>
                                    <th class="nk-tb-col tb-col-lg">Total</th>
                                    <th class="nk-tb-col tb-col-lg">Tracking</th>
                                    <th class="nk-tb-col tb-col-md">Itmes</th>
                                    {{-- <th class="nk-tb-col tb-col-md">Curior</th> --}}
                                    <th class="nk-tb-col tb-col-md">Action</th>

                                </tr>
                            </thead>
                            <tbody id="order_table">
                                @if (isset($orders))

                                @foreach ($orders as $order)
                                @if ( $setting->order_status == 'all')
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <input type="checkbox" name="" class="order_check " value="{{ $order->id }}">
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $order->id }}<span
                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-info">
                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->billing->first_name. " ".  $order->billing->last_name }}
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
                                        <span class="tb-amount">{{ $order->status }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$order->date_created}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                        {{ $order->total }}
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        {{ count($order->line_items) }}
                                    </td>
                                   
                                    <td class="nk-tb-col tb-col-md">

                                        {{-- <a href="{{ route('orders.show',$order->id) }}"
                                            class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                            {{-- <ul class="nk-tb-actions gx-1"> --}}
                                            <li class="nk-tb-action-hidden list-unstyled">
                                                <a  href="{{ route('orders.show',$order->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Suspend">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            </li>
                                            
                                       
                                    </td>

                                </tr><!-- .nk-tb-item  -->

                                @else

                                @if ($order->status == $setting->order_status)

                               <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <input type="checkbox" name="" class="order_check " value="{{ $order->id }}">
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $order->id }}<span
                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-info">
                                            <a href="{{ route('orders.show',$order->id) }}">{{ $order->billing->first_name. " ".  $order->billing->last_name }}
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
                                        <span class="tb-amount">{{ $order->status }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$order->date_created}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                        {{ $order->total }}
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        {{ count($order->line_items) }}
                                    </td>
                                   
                                    <td class="nk-tb-col tb-col-md">

                                        {{-- <a href="{{ route('orders.show',$order->id) }}"
                                            class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a> --}}
                                            {{-- <ul class="nk-tb-actions gx-1"> --}}
                                            <li class="nk-tb-action-hidden list-unstyled">
                                                <a  href="{{ route('orders.show',$order->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Suspend">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            </li>
                                            
                                       
                                    </td>

                                </tr><!-- .nk-tb-item  -->
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
                        <select id="change_order_status" name="order_status" class="form-control form-select"
                            data-search="on">
                            <option disabled selected>Choose Status</option>
                            <option value="pending">Pending payment</option>
                            <option value="processing">Processing</option>
                            <option value="on-hold">On hold</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="refunded">Refunded</option>
                            <option value="failed">Failed</option>
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
    $("#orders_check").click(function () {
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

</script>
@endsection
