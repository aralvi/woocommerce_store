@extends('layouts.admin') @section('title','Products') @section('page-title','Products/Edit') @section('content')
<div class="col-xxl-12 col-sm-12">
	<div class="card card-preview">
		<div class="nk-ecwg nk-ecwg6">
			<div class="card-inner"> {{-- card header section --}}
				<div class="card-title-group"></div> {{-- card header section end --}}
				<div class="data">
					<form action="{{ route('products.update',$product['id']) }}" id="productEditForm" class="form-validate is-alter" method="POST"> @method('put') @csrf
						<input type="hidden" name="store_url" class="store_url" value="{{ isset($store_url)? $store_url : '' }}">
				<input type="hidden" name="consumer_key" class="consumer_key" value="{{ isset($consumer_key)? $consumer_key:'' }}">
				<input type="hidden" name="consumer_secret" class="consumer_secret" value="{{ isset($consumer_secret)? $consumer_secret : '' }}">
                        <div class="row">
							<div class="form-group col-md-6">
								<label for="name" class="mb-0">Name</label>
								<input type="text" name="name" id="name" value="{{ $product['name'] }}" class="form-control" >
							</div>
							<div class="form-group col-md-6">
								<label for="regular_price" class="mb-0">Regular Price</label>
								<input type="number" name="regular_price" id="regular_price" value="{{ $product['regular_price'] }}" class="form-control" > 
                            </div>
							<div class="form-group col-md-6">
								<label for="purchase_price" class="mb-0">Purchase Price</label>
								<input type="number" name="purchase_price" id="purchase_price" value="{{ isset($product['purchase_price'])? $product['purchase_price'] :''}}" class="form-control"> 
                            </div>
							<div class="form-group col-md-6">
								<label for="sale_price" class="mb-0">Sale Price</label>
								<input type="number" name="sale_price" id="sale_price" value="{{ $product['sale_price'] }}" class="form-control"> 
                            </div>
							<div class="form-group col-md-6">
								<label for="sku" class="mb-0">Sku</label>
								<input type="text" name="sku" id="sku" value="{{ $product['sku'] }}" class="form-control"> 
                            </div>
							<div class="form-group col-md-6">
								<label for="status" class="mb-0">status</label>
								<select id="product_status" name="product_status" class="form-control form-select" data-search="on">
									<option disabled selected>Choose Status</option>
									<option value="publish" {{ $product[ 'status']=='publish' ? 'selected': '' }}>Publish</option>
									<option value="draft" {{ ($product[ 'status']=='draft' )? 'selected': '' }}>Draft</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="supplier" class="mb-0">Suppliers</label>
								<select id="product_supplier" name="product_supplier" class="form-control form-select" data-search="on">
									<option disabled selected>Choose supplier</option>
									
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="supplier_sku" class="mb-0">Supplier Sku</label>
								<input type="text" name="supplier_sku" id="name" value="{{ isset($product['supplier_sku'])?$product['supplier_sku']:'' }}" class="form-control  " >
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="preview-block"> <span class="preview-title overline-title">Manage Stock</span>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input"  name="manage_stock" value="true" id="customCheck2">
										<label class="custom-control-label" for="customCheck2"></label>
									</div>
								</div>
							</div>
                        </div>
                            {{-- <div class="d-none row" id="manage_stock_yes">
                                <div class="form-group col-md-6">
                                    <label for="stock_quantity" class="mb-0">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ $product['stock_quantity'] }}" class="form-control"> 
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
                                    <input type="number" name="weight" id="weight" value="{{ $product['weight'] }}" class="form-control"> 
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
                                        <textarea class="form-control" name="purchase_note" id="default-textarea">{{ $product['purchase_note'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="preview-block"> 
                                        <span class="preview-title overline-title mt-2">Catalog Visibility</span>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="visible" checked="" name="catalog_visibility" id="customSwitch2">
                                            <label class="custom-control-label" for="customSwitch2">Visible</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<div class="form-group mt-3">
							<button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
						</div>
					</form>
				</div>
			</div>
			<!-- .card-inner -->
		</div>
		<!-- .nk-ecwg -->
	</div>
	<!-- .card -->
</div> @endsection @section('script')
<script>
    let stock_yes  = `
                                <div class="form-group col-md-6">
                                    <label for="stock_quantity" class="mb-0">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ $product['stock_quantity'] }}" class="form-control"> 
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
                                    <input type="number" name="out_stock_threshold" id="out_stock_threshold" value="{{ isset($product['out_stock_threshold'])?$product['out_stock_threshold']:'' }}" class="form-control"> 
                                </div>
                                `;
    let stock_no = `
                                <div class="form-group col-md-6">
                                    <label for="weight" class="mb-0">Weight</label>
                                    <input type="number" name="weight" id="weight" value="{{ $product['weight'] }}" class="form-control"> 
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
                                        <textarea class="form-control" name="purchase_note" id="default-textarea">{{ $product['purchase_note'] }}</textarea>
                                    </div>
                                </div>`;
$("#customCheck2").click(function() {
	if($(this).is(':checked')) {
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