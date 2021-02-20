@extends('layouts.admin')

@section('title','Products') 
@section('page-title','Products/Edit')
@section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card card-preview">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                     <form action="{{ route('products.update',$product['id']) }}" id="productEditForm" class="form-validate is-alter" method="POST">
                            @method('put')
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="mb-0">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $product['name'] }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="regular_price" class="mb-0">Regular Price</label>
                                        <input type="number" name="regular_price" id="regular_price"  value="{{ $product['regular_price'] }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="purchase_price" class="mb-0">Purchase Price</label>
                                        <input type="number" name="purchase_price" id="purchase_price" value="{{ $product['purchase_price'] }}"  class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price" class="mb-0">Sale Price</label>
                                        <input type="number" name="sale_price" id="sale_price" value="{{ $product['sale_price'] }}"  class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sku" class="mb-0">Sku</label>
                                        <input type="text" name="sku" id="sku" value="{{ $product['sku'] }}"  class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status" class="mb-0">status</label>
                                        <input type="text" name="status" id="status" value="{{ $product['status'] }}"  class="form-control">
                                    </div>
                                     <div class="col-md-12 col-sm-12">
                                        <div class="preview-block">
                                            <span class="preview-title overline-title">Catalog Visibility</span>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" checked="" name="catalog_visibility" id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2">Visible</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
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
</div>

@endsection

@section('script')
<script>
   

</script>
@endsection






