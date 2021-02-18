@extends('layouts.admin')
@section('style')
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    #close {
        position: absolute;
        top: 70px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    #close:hover,
    #close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

</style>
@endsection
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
                                    <th class="nk-tb-col tb-col-mb">Sku</th>
                                    <th class="nk-tb-col tb-col-md">Barcode</th>
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
                                    <td class="nk-tb-col tb-col-md">
                                        <a href="{{ route('products.show',$product->id) }}">{{ $product->name }}</a>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <input type="text" name="barcode" class="form-control">
                                    </td>
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

        $(document.body).on("click", "img.product_image", function () {
            // Get the modal
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = $(this).attr('src');

            // Get the <span> element that closes the modal
            var span = document.getElementById("close");

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }
        });

    });

</script>
@endsection
