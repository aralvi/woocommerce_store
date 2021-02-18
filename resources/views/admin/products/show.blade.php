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
                                <div id="product-23" class="product type-product post-23 status-publish first instock product_cat-accessories has-post-thumbnail sale shipping-taxable purchasable product-type-simple">
                                    <div class="row d-flex ">

                                    <div
                                        class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                        data-columns="4"
                                        style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;"
                                    >
                                        <figure class="woocommerce-product-gallery__wrapper">
                                            @if ($product['images'] != null)

                                            <div data-thumb="{{ $product['images'][0]->src }}" data-thumb-alt="" class="woocommerce-product-gallery__image">
                                                <a href="{{ $product['images'][0]->src }}">
                                                    <img
                                                        width="600"
                                                        height="600"
                                                        src="{{ $product['images'][0]->src }}"
                                                        class="wp-post-image"
                                                        alt=""
                                                        loading="lazy"
                                                        title="beanie-2.jpg"
                                                        data-caption=""
                                                        data-src="{{ $product['images'][0]->src }}"
                                                        data-large_image="{{ $product['images'][0]->src }}"
                                                        data-large_image_width="801"
                                                        data-large_image_height="801"
                                                        srcset="{{ $product['images'][0]->src }} 600w, {{ $product['images'][0]->src }} 300w, {{ $product['images'][0]->src }} 100w, {{ $product['images'][0]->src }} 150w, {{ $product['images'][0]->src }} 768w, {{ $product['images'][0]->src }} 801w"
                                                        sizes="(max-width: 600px) 100vw, 600px"
                                                    />
                                                </a>
                                            </div>
                                            @else
                                            <div data-thumb="" data-thumb-alt="" class="woocommerce-product-gallery__image">
                                                <a href="">
                                                    <img
                                                        width="600"
                                                        height="600"
                                                        src="{{ asset('assets/images/product/default.jpg') }}"
                                                        class="wp-post-image"
                                                    />
                                                </a>
                                            </div>

                                            @endif
                                        </figure>
                                    </div>

                                    <div class="summary entry-summary pl-5 col-md-6">
                                        <h1 class="product_title entry-title text-capitalize">{{ $product['name'] }}</h1>
                                            <div class="d-flex align-items-center ">

                                                <h4 class="m-0">Price: </h4>
                                                @if ($product['sale_price'] != '')
                                                    
                                                <del class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product['regular_price'] }}</bdi>
                                                    </span>
                                                </del>
                                                <ins class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product['sale_price'] }}</bdi>
                                                    </span>
                                                </ins>
                                                @else
                                                <ins class="pl-3">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ $product['regular_price'] }}</bdi>
                                                    </span>
                                                </ins>
                                                @endif
                                            </div>
                                        <div class="woocommerce-product-details__short-description">
                                            <p>{!! $product['short_description'] !!}</p>
                                        </div>
                                        {{-- <form class="cart" action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="quantity">
                                                <label class="screen-reader-text" for="quantity_6027708f9c785">{{ ['name'] }}</label>
                                                <input type="number" id="quantity_6027708f9c785" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                                            </div>
                                            <button type="submit" name="add-to-cart" value="{{ $product['id'] }}" class="single_add_to_cart_button button alt">Add to cart</button>
                                        </form> --}}
                                        <div class="product_meta">
                                            <span class="sku_wrapper">SKU: <span class="sku">{{ $product['sku'] }}</span></span><br>
                                            <span class="posted_in">Category: {{ $product['categories'][0]->name }}</span>
                                        </div>
                                    </div>
                                    </div>

                                    @if ($product['description'] !='')
                                        
                                    <div class="woocommerce-tabs wc-tabs-wrapper">

                                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="">
                                            <h2>Description</h2>

                                            <p>
                                                {!!$product['description']!!}
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
@endsection @section('script')
<script></script>
@endsection
@section('expiry_time')
	@if (isset($setting))
            
        <input type="hidden"  id="expiry_page_time" value="{{ $setting->expiry_time }}">
        @else
        <input type="hidden"  id="expiry_page_time" value="900000">
            
        @endif
@endsection