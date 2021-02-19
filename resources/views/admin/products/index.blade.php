@extends('layouts.admin')

@section('title','Products') @section('page-title','Product Lists') @section('content')
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
                                <div class="form-control-wrap select_store">
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
                        <div class="col-md-4">


                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <div id="products_table">

                        <div class="spinner-border text-secondary d-none" id="loading" role="status">
                            <span class="sr-only">

                            </span>
                        </div>
                        <table class="datatable-init nowrap nk-tb-list is-separate dataTable no-footer"
                            data-auto-responsive="false">
                            <thead class="thead-dark">
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"># </th>
                                    <th class="nk-tb-col nk-tb-col-check">Image</th>
                                    <th class="nk-tb-col">Name </th>
                                    {{-- <th class="nk-tb-col tb-col-mb">Sku</th>
                                    <th class="nk-tb-col tb-col-md">Barcode</th> --}}
                                    <th class="nk-tb-col tb-col-lg">Stock Status</th>
                                    <th class="nk-tb-col tb-col-md">Action</th>
    
                                </tr>
                            </thead>
                            <tbody id="product_table">
                                @if (isset($products))
    
                                @foreach ($products as $product)
    
                                <tr class="nk-tb-item">
    
                                    <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $product->id }}<span
                                                    class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        @if (count($product->images) <> 0) <img id="myImg" class="product_image" alt="Snow"
                                                style="width:100%;max-width:300px" src="{{ $product->images[0]->src }}"
                                                alt="" width="60" height="60">
                                            @endif
                                    </td>
                                    <td class="nk-tb-col tb-col-md ">
                                        <a href="{{ route('products.show',$product->id) }}">{{ $product->name }}</a><br>
                                        <small>SKU: {{ $product->sku }}</small><br>
                                        <small>Barcode: </small>
                                    </td>
                                    {{-- <td class="nk-tb-col tb-col-lg">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <input type="text" name="barcode" class="form-control">
                                    </td> --}}
                                    <td class="nk-tb-col tb-col-lg">
                                        @if ($product->stock_status == 'instock')
                                        <p class="text-success">
    
                                            {{ $product->stock_status }}
                                        </p>
                                        @else
                                        <p class="text-danger">
    
                                            {{ $product->stock_status }}
                                        </p>
    
                                        @endif
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        {{-- <a class="btn btn-dim btn-sm btn-primary"
                                            href="{{ route('products.show',$product->id) }}"><i
                                                class="icon ni ni-eye"></i></a> --}}
                                                <li class="nk-tb-action-hidden list-unstyled">
                                                <a href="{{ route('products.show',$product->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="View Detail">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            </li>
                                    </td>
    
                                </tr><!-- .nk-tb-item  -->
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
                <h5 class="modal-title">Update Product</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="requestdata">

            </div>

        </div>
    </div>
</div>

{{-- delete mdal  --}}

<div class="modal fade zoom" tabindex="-1" id="DeleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Product</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delte this Product?</p>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-dim btn-danger" id="deleteProductModalBtn">Yes,sure</button>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <span id="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        $('#stores').on('change', function (e) {
            var store_url = $(this).val();
            var key = $(this).children("option:selected").attr('data-key');
            var secret = $(this).children("option:selected").attr('data-secret');
            $('#loading').removeClass('d-none');
            $.ajax({
                type: "post",
                url: "{{ route('product.store')}}",
                data: {
                    store_url: store_url,
                    key: key,
                    secret: secret,
                    _token: "{{ csrf_token() }}"
                },

                success: function (data) {
                    $('#products_table').empty();
                    $('#products_table').html(data);
                },
            });
        });

        

    });

</script>
@endsection
