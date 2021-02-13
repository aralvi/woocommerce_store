@extends('layouts.admin')
@section('title','Orders')
@section('page-title','Order Lists')
@section('content')
@if (isset($setting))
<div class="col-xxl-12 col-sm-12">
    <div class="card">
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
                                        @foreach ($shops as $shop)
                                        @if ((Auth::user()->id == $shop->user_id) || Auth::user()->role == 'SuperAdmin')

                                        <option class="text-capitalize" value="{{ $shop->store_url }}"
                                            data-key="{{ $shop->consumer_key }}"
                                            data-secret="{{ $shop->consumer_secret }}"
                                            {{ ($shop->id == $setting->shop_id) ? "selected":'' }}>{{ $shop->name }}
                                        </option>
                                        @endif

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="mb-0">Select curior Service</label>
                                <div class="form-control-wrap">
                                    <select class="form-select form-control form-control-lg" data-search="on">
                                        <option value="default_option">Choose Curier service</option>
                                        <option value="option_select_name">TCS</option>
                                        <option value="option_select_name">Lepord</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- <div class="form-group">
                                <label for="filter By Status" class="mb-0">Search</label>
                                <input class="mu-input-box form-control" name="order_search" id="search_order"
                                    type="text" placeholder="search order status" />
                            </div> --}}
                        </div>
                        <div class="col-md-4">


                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="filter By Status" class="mb-0">Filter Status</label>
                                <select id="order_status" name="order_status" class="form-control form-select"
                                    data-search="on">
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
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="data-group table-responsive ">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" name="" class="order_check" id="orders_check">
                                    </th>
                                    <th scope="col">Order# </th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Tracking</th>
                                    <th scope="col">Itmes</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="order_table">
                                @foreach ($orders as $order)

                                <tr>
                                    <td><input type="checkbox" name="" class="order_check"></td>
                                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td class="w-296">
                        {{$order->date_created}}
                    </td>
                    <td>{{ $order->total }}</td>
                    <td></td>
                    <td>{{ count($order->line_items) }}</td>
                    <td><a href="{{ route('orders.show',$order->id) }}"><i class="icon ni ni-eye"></i></a> </td>
                    </tr>
                    @endforeach

                    </tbody>

                    </table>
                </div> --}}
                <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                    <thead class="thead-dark">
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" name="" class="order_check " id="orders_check">
                                </div>
                            </th>
                            <th class="nk-tb-col">Order# </th>
                            <th class="nk-tb-col tb-col-mb">Status</th>
                            <th class="nk-tb-col tb-col-md">Date</th>
                            <th class="nk-tb-col tb-col-lg">Total</th>
                            <th class="nk-tb-col tb-col-lg">Tracking</th>
                            <th class="nk-tb-col tb-col-md">Itmes</th>
                            <th class="nk-tb-col tb-col-md">Curior</th>
                            <th class="nk-tb-col tb-col-md">Action</th>

                        </tr>
                    </thead>
                    <tbody id="order_table">

                        @foreach ($orders as $order)
                        @if ($order->status == $setting->order_status)

                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" name="" class="order_check ">
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $order->id }}<span
                                            class="dot dot-success d-md-none ml-1"></span></span>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-mb">
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
                            <td class="nk-tb-col tb-col-lg">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select form-control form-control-lg" data-search="on">
                                            <option value="default_option">Choose Curier service</option>
                                            <option value="option_select_name">TCS</option>
                                            <option value="option_select_name">Lepord</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-dim btn-primary"><i class="icon ni ni-eye"></i></a>
                                <button class="btn btn-sm btn-dim btn-primary order_status"
                                    data-orderId="{{ $order->id }}"><i class="icon ni ni-pen"></i></button>
                                    <button type="button" class="btn btn-sm btn-dim btn-primary orderNote" data-orderId="{{ $order->id }}"><i class="icon ni ni-plus"></i>Note</button>
                                    <form action="{{ route('ordernotes.index') }}" method="get">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button type="subbmit" class="btn btn-sm btn-dim btn-primary" ><i class="icon ni ni-eye"></i> Note</button>
                                    </form>
                            </td>

                        </tr><!-- .nk-tb-item  -->
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- .card-inner -->
    </div>
    <!-- .nk-ecwg -->
</div>
<!-- .card -->
</div>
@endif
<div class="modal fade zoom" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Status</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('orders.index') }}" id="orderStatus" class="form-validate is-alter" method="POST">
                @method('put')
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="filter By Status" class="mb-0">Order Stataus</label>
                        <select id="order_status" name="order_status" class="form-control form-select" data-search="on">
                            <option disabled selected>Choose Status</option>
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
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
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
    $("#orders_check").click(function () {
        if ($(this).is(':checked')) {

            $('.order_check').attr('checked', 'checked');
        } else {

            $('.order_check').removeAttr('checked', 'checked');

        }
    });
    $("#order_status").on('change', function () {
        $status = $(this).val();


        $.ajax({
            type: 'get',
            url: "{{ url('order')}}" + "/" + $status,
            success: function (data) {
                $('#order_table').empty();
                $('#order_table').html(data);
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
                $('#order_table').empty();
                $('#order_table').html(data);
            },
        });

    });

</script>
@endsection
