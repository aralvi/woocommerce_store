@extends('layouts.admin') @section('title','Orders') @section('page-title','Order Lists') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    <div class="row mb-4">
                        <div class="col-md-8">


                        </div>
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="filter By Status" class="mb-0">Search</label>
                                    <input class="mu-input-box form-control" name="order_search" id="search_order" type="text"  placeholder="search order status" />
                                </div>
                        </div>
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label for="filter By Status" class="mb-0">Filter Status</label>
                                    <select id="order_status" name="order_status" class="form-control" >
                                        <option value="all" selected>All</option>
                                        <option value="pending">Pending payment</option>
                                        <option value="processing" >Processing</option>
                                        <option value="on-hold">On hold</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                        <option value="failed">Failed</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="data-group table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" name="" id="">
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
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="w-296">
                                        {{$order->date_created}}
                                    </td>
                                    <td>{{ $order->total }}</td>
                                    <td></td>
                                    <td>{{ count($order->line_items) }}</td>
                                    <td><a href="{{ route('orders.show',$order->id) }}">view more</a> </td>
                                </tr>
                                @endforeach

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
@endsection @section('script')
<script>
     $("#order_status").on('change',function(){
        $status = $(this).val();
        

        $.ajax({
            type: 'get',
            url : "{{ url('order')}}"+"/"+$status,
            success: function(data){
                $('#order_table').empty();
                $('#order_table').html(data);
            }
        });

    });
    $('#search_order').on('input',function(e){
        var query = $(this).val();
        $.ajax({
        type: "post",
        url: "{{ route('order.search')}}",
        data: {query: query, _token: "{{ csrf_token() }}"},

        success: function(data) {
            $('#order_table').empty();
            $('#order_table').html(data);
        }
        , });

    });
</script>
@endsection
