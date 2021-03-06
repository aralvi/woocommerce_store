@extends('layouts.admin') @section('title','Product') @section('page-title','Product Detail') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    <div class="row rsrc-content">
                        <div class="col-md-12 rsrc-main">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <div id="product-23"
                                    class="product type-product post-23 status-publish first instock product_cat-accessories has-post-thumbnail sale shipping-taxable purchasable product-type-simple">
                                    <div class="row d-flex ">

                                        <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                            data-columns="4"
                                            style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
                                            <figure class="woocommerce-product-gallery__wrapper">
                                                @if ($product->image != null)

                                                <div data-thumb="{{ $product->image }}" data-thumb-alt=""
                                                    class="woocommerce-product-gallery__image">
                                                    <a href="{{ $product->image }}">
                                                        <img width="600" height="600"
                                                            src="{{ $product->image }}" class="wp-post-image"
                                                            alt="" loading="lazy" title="beanie-2.jpg" data-caption=""
                                                            data-src="{{ $product->image }}"
                                                            data-large_image="{{ $product->image }}"
                                                            data-large_image_width="801" data-large_image_height="801"
                                                            srcset="{{ $product->image }} 600w, {{ $product->image }} 300w, {{ $product->image }} 100w, {{ $product->image }} 150w, {{ $product->image }} 768w, {{ $product->image }} 801w"
                                                            sizes="(max-width: 600px) 100vw, 600px" />
                                                    </a>
                                                </div>
                                                @else
                                                <div data-thumb="" data-thumb-alt=""
                                                    class="woocommerce-product-gallery__image">
                                                    <a href="">
                                                        <img width="600" height="600"
                                                            src="{{ asset('assets/images/product/default.jpg') }}"
                                                            class="wp-post-image" />
                                                    </a>
                                                </div>

                                                @endif
                                            </figure>
                                        </div>

                                        <div class="summary entry-summary pl-5 col-md-6">
                                            <h1 class="product_title entry-title text-capitalize text-primary"
                                                data-toggle="modal" data-target="#modalLarge">{{ $product->name }}
                                            </h1>
                                            <div class="d-flex align-items-center ">

                                                <h4 class="m-0">Price: </h4>
                                                @if ($product->sale_price != '')

                                                <del class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $product->regular_price }}</bdi>
                                                    </span>
                                                </del>
                                                <ins class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $product->sale_price }}</bdi>
                                                    </span>
                                                </ins>
                                                @else
                                                <ins class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $product->regular_price }}</bdi>
                                                    </span>
                                                </ins>
                                                @endif
                                            </div>
                                            <div class="woocommerce-product-details__short-description">
                                                <p>{!! $product->short_description !!}</p>
                                            </div>
                                            {{-- <form class="cart" action="{{ route('orders.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="quantity">
                                                <label class="screen-reader-text"
                                                    for="quantity_6027708f9c785">{{ ->name }}</label>
                                                <input type="number" id="quantity_6027708f9c785"
                                                    class="input-text qty text" step="1" min="1" max="" name="quantity"
                                                    value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                                            </div>
                                            <button type="submit" name="add-to-cart" value="{{ $product->id }}"
                                                class="single_add_to_cart_button button alt">Add to cart</button>
                                            </form> --}}
                                            <div class="product_meta">
                                                <span class="sku_wrapper">SKU: <span
                                                        class="sku">{{ $product->sku }}</span></span><br>
                                                <span class="posted_in">Category:
                                                    {{ $product->category }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($product->description !='')

                                    <div class="woocommerce-tabs wc-tabs-wrapper">

                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab"
                                            id="tab-description" role="tabpanel" aria-labelledby="tab-title-description"
                                            style="">
                                            <h2>Description</h2>

                                            <p>
                                                {!!$product->description!!}
                                            </p>
                                        </div>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /#content -->
                    </div>
                </div>
            </div>
            <!-- .card-inner -->
        </div>
        <!-- .nk-ecwg -->
    </div>
    <!-- .card -->
</div>


{{-- edit product modal --}}
<div class="modal fade" tabindex="-1" id="modalLarge" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Product</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update',$product->id) }}" id="productEditForm"
                    class="form-validate is-alter" method="POST"> @method('put') @csrf
                    <input type="hidden" name="store_url" class="store_url"
                        value="{{ isset($store_url)? $store_url : '' }}">
                    <input type="hidden" name="consumer_key" class="consumer_key"
                        value="{{ isset($consumer_key)? $consumer_key:'' }}">
                    <input type="hidden" name="consumer_secret" class="consumer_secret"
                        value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="mb-0">Name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="regular_price" class="mb-0">Regular Price</label>
                            <input type="number" name="regular_price" id="regular_price"
                                value="{{ $product->regular_price }}" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="purchase_price" class="mb-0">Purchase Price</label>
                            <input type="number" name="purchase_price" id="purchase_price"
                                value="{{ isset($product->purchase_price)? $product->purchase_price :''}}"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sale_price" class="mb-0">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" value="{{ $product->sale_price }}"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sku" class="mb-0">Sku</label>
                            <input type="text" name="sku" id="sku" value="{{ $product->sku }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status" class="mb-0">status</label>
                            <select id="product_status" name="product_status" class="form-control form-select"
                                data-search="on">
                                <option disabled selected>Choose Status</option>
                                <option value="publish" {{ $product->status=='publish' ? 'selected': '' }}>Publish
                                </option>
                                <option value="draft" {{ ($product->status=='draft' )? 'selected': '' }}>Draft
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="supplier" class="mb-0">Suppliers</label>
                            <select id="product_supplier" name="product_supplier" class="form-control form-select"
                                data-search="on">
                                <option disabled selected>Choose supplier</option>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="supplier_sku" class="mb-0">Supplier Sku</label>
                            <input type="text" name="supplier_sku" id="name"
                                value="{{ isset($product->supplier_sku)?$product->supplier_sku:'' }}"
                                class="form-control  ">
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="preview-block"> <span class="preview-title overline-title">Manage Stock</span>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="manage_stock" value="true"
                                        id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-none row" id="manage_stock_yes">
                                <div class="form-group col-md-6">
                                    <label for="stock_quantity" class="mb-0">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ $product->stock_quantity }}"
                    class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="backorders" class="mb-0">Back Order</label>
                <select id="backorders" name="backorders" class="form-control form-select" data-search="on">
                    <option disabled selected>Choose backorder</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div> --}}

        <div class="row" id="manage_stock_div">
            <div class="form-group col-md-6">
                <label for="weight" class="mb-0">Weight</label>
                <input type="number" name="weight" id="weight" value="{{ $product->weight }}" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="stock_status" class="mb-0">Stock Status</label>
                <select id="stock_status" name="stock_status" class="form-control form-select" data-search="on">
                    <option value="instock" selected="selected">In stock</option>
                    <option value="outofstock">Out of stock</option>
                    <option value="onbackorder">On backorder</option>

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="shipping_class" class="mb-0">Shipping Class</label>
                <select id="shipping_class" name="shipping_class" class="form-control form-select" data-search="on">
                    <option disabled selected>Choose Shipping Class</option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <div class="form-control-wrap">
                    <label for="default-textarea" class="mb-0">Purchase Note</label>
                    <textarea class="form-control" name="purchase_note"
                        id="default-textarea">{{ $product->purchase_note }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="preview-block">
                    <span class="preview-title overline-title mt-2">Catalog Visibility</span>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" value="visible" checked=""
                            name="catalog_visibility" id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Visible</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-light">
        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
    </div>
    </form>
</div>
</div>
</div>
@endsection @section('script')
<script>
    let stock_yes = `
                                <div class="form-group col-md-6">
                                    <label for="stock_quantity" class="mb-0">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="backorders" class="mb-0">Back Order</label>
                                    <select id="backorders" name="backorders" class="form-control form-select" data-search="on">
                                        <option value="no" selected="selected">Do not allow</option>
                                        <option value="notify">Allow, but notify customer</option>
                                        <option value="yes">Allow</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="out_stock_threshold" class="mb-0">Stock Trash</label>
                                    <input type="number" name="out_stock_threshold" id="out_stock_threshold" value="{{ isset($product->out_stock_threshold)?$product->out_stock_threshold:'' }}" class="form-control"> 
                                </div>
                                `;
    let stock_no = `
                                <div class="form-group col-md-6">
                                    <label for="weight" class="mb-0">Weight</label>
                                    <input type="number" name="weight" id="weight" value="{{ $product->weight }}" class="form-control"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="stock_status" class="mb-0">Stock Status</label>
                                    <select id="stock_status" name="stock_status" class="form-control form-select" data-search="on">
                                        <option value="instock" selected="selected">In stock</option>
                                        <option value="outofstock">Out of stock</option>
                                        <option value="onbackorder">On backorder</option>	
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="shipping_class" class="mb-0">Shipping Class</label>
                                    <select id="shipping_class" name="shipping_class" class="form-control form-select" data-search="on">
                                        <option disabled selected>Choose Shipping Class</option>
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-control-wrap">
                                        <label for="default-textarea" class="mb-0">Purchase Note</label>
                                        <textarea class="form-control" name="purchase_note" id="default-textarea">{{ $product->purchase_note }}</textarea>
                                    </div>
                                </div>`;
    $("#customCheck2").click(function () {
        if ($(this).is(':checked')) {
            // $('#manage_stock_yes').removeClass('d-none');
            // $('#manage_stock_no').addClass('d-none');
            $('#manage_stock_div').empty()
            $('#manage_stock_div').append(stock_yes)
        } else {
            $('#manage_stock_div').empty()
            $('#manage_stock_div').append(stock_no)
            // $('#manage_stock_no').removeClass('d-none');
            // $('#manage_stock_yes').addClass('d-none');
        }
    });

</script> @endsection
