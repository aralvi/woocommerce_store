@extends('layouts.admin') @section('title','Order detail') @section('page-title','Order Detail') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group">

                </div>
                {{-- card header section end --}}
                <div class="data">
                    {{-- <div class="data-group table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Image
                                    </th>
                                    <th scope="col">Qty to ship</th>
                                    <th scope="col"><button class="border-0">-</button> Qty <button class="border-0">+</button></th>
                                    <th scope="col">Sku</th>
                                    <th scope="col">supplier</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Scan status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders['line_items'] as $key=> $product)
                                    
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                    <td>
                        @foreach ($products as $item)
                        @if ($product->product_id == $item->id)
                        <img src="{{ $item->images[0]->src }}" alt="" width="60" height="60">
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $product->quantity }}</td>
                    <td class="w-296">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" id="sub" class="sub border">--</button>
                            <button type="button" id="sub" class="sub border">-</button>
                            <input type="number" id="1" value="{{ $product->quantity }}" min="0" class="quantity" />
                            <button type="button" id="add" class="add border">+</button>
                            <button type="button" id="add" class="add border">++</button>
                        </div>
                    </td>
                    <td>{{ $product->sku }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach ($products as $item)
                        @if ($product->product_id == $item->id)
                        <p class="{{ $item->stock_status == 'instock'? "text-success":'text-danger' }} ">
                            {{ $item->stock_status }}</p>
                        @endif
                        @endforeach
                    </td>
                    </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                        <th colspan="3" class="text-right pt-3">Total Weight</th>
                        <td><input type="number" name="" id="" class="form-control" /></td>
                        <th colspan="3" class="text-right pt-3">Product count</th>
                        <td colspan="2"><input type="number" name="" id="" class="form-control count" /></td>
                    </tfoot>
                    </table>
                </div> --}}
                <div class="col-md-12 d-flex justify-content-between mb-2 p-0">
                    <div class="">
                        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Enter barcode">
                    </div>
                    <div class="btn-group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-dim btn-primary ml-1 order_status"  data-orderId="{{ $orders['id'] }}">Change Order status</button>
                        <button type="button" class="btn btn-sm btn-dim btn-primary ml-1 orderNote" data-orderId="{{ $orders['id'] }}">Add Note</button>
                        <form action="{{ route('ordernotes.index') }}" method="get" class="ml-1">
                                    <input type="hidden" name="order_id" value="{{ $orders['id'] }}">
                                    <button type="subbmit" class="btn btn-dim btn-primary" >view Note</button>
                                    </form>
                    </div>
                </div>
                <table class=" datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    #
                                </div>
                            </th>
                            <th class="nk-tb-col ">Image</th>
                            <th class="nk-tb-col tb-col-mb ">Qty to ship</th>
                            <th class="nk-tb-col tb-col-md "><button class="border-0 btn btn-sm btn-primary btn-dim">-</button> Qty <button
                                    class="border-0 btn btn-sm btn-primary btn-dim">+</button></th>
                            <th class="nk-tb-col tb-col-lg ">Sku</th>
                            <th class="nk-tb-col tb-col-lg ">supplier</th>
                            {{-- <th class="nk-tb-col tb-col-md ">Barcode</th> --}}
                            <th class="nk-tb-col tb-col-md ">Product Name</th>
                            <th class="nk-tb-col tb-col-md ">Scan status</th>

                        </tr>
                    </thead>
                    <tbody id="order_table">

                        @foreach ($orders['line_items'] as $key=> $product)

                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    {{ $product->product_id }}
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-info">
                                    @foreach ($products as $item)
                                    @if ($product->product_id == $item->id)
                                    @if (count($item->images) < 0) <img src="{{ $item->images[0]->src }}" alt=""
                                        width="60" height="60">
                                        @endif
                                        @endif
                                        @endforeach
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-mb">
                                <span class="tb-amount ship_quantity">{{ $product->quantity }}</span>
                            </td>
                            <td class="td_quantity">
                                <div class="d-flex justify-content-between align-items-center btn-group">
                                    <button type="button" id="sub" class="sub border btn btn-sm btn-primary btn-dim">--</button>
                                    <button type="button" id="sub" class="sub border btn btn-sm btn-primary btn-dim">-</button>
                                    <input type="number" id="1" value="0" min="0" class="quantity" />
                                    <button type="button" id="add" class="add border btn btn-sm btn-primary btn-dim">+</button>
                                    <button type="button" id="add" class="add border btn btn-sm btn-primary btn-dim">++</button>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                {{ $product->sku }}
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                            </td>
                            {{-- <td class="nk-tb-col tb-col-lg">
                                <input type="text" name="barcode" class="form-control">
                            </td> --}}
                            <td class="nk-tb-col tb-col-lg">
                                {{ $product->name }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @foreach ($products as $item)
                                @if ($product->product_id == $item->id)
                                <p class="{{ $item->stock_status == 'instock'? "text-success":'text-danger' }} ">
                                    {{ $item->stock_status }}</p>
                                @endif
                                @endforeach
                            </td>

                        </tr><!-- .nk-tb-item  -->
                        @endforeach

                    </tbody>
                    <tfoot>
                        <th colspan="3" class="text-right pt-3">Total Weight</th>
                        <td><input type="number" name="" id="" class="form-control" /></td>
                        <th colspan="3" class="text-right pt-3">Product count</th>
                        <td colspan="2"><input type="number" name="count" value="" id="" class="form-control count" readonly/></td>
                    </tfoot>
                </table>
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
    $(document).ready(function () {


        $(".add").click(function () {
            $quantity = $(this).prev().val(+$(this).prev().val() + 1);
            
            if($('.ship_quantity').text() > $quantity.val())
            {
                $('.quantity').css("border", "1px solid yellow");
            }
             if($('.ship_quantity').text() ==  $quantity.val()){
                 $('.quantity').css("border", "1px solid green");
             }
             if($('.ship_quantity').text() <  $quantity.val()){
                 $('.quantity').css("border", "1px solid red");
             }
            

           

        });
        $(".sub").click(function () {
            if ($(this).next().val() > 1) {
                $(this)
                    .next()
                    .val(+$(this).next().val() - 1);
               
            }
        });

    });

    

</script>
@endsection
