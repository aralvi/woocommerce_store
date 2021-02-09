@extends('layouts.admin') @section('title','Orders') @section('page-title','Order Lists') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
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
                            <tbody>
                                @foreach ($orders as $order)
                                    
                                <tr>
                                    <td><input type="checkbox" name="" id=""></td>
                                    <td>{{ $order->order_key }}</td>
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
</script>
@endsection
