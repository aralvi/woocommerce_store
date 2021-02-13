@extends('layouts.admin') @section('title','Products') @section('page-title','Product Lists') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
                {{-- card header section end --}}
                <div class="data">
                    
                    
                    <table class="datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead class="thead-dark">
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col"># </th>
                                <th class="nk-tb-col nk-tb-col-check">Image</th>
                                <th class="nk-tb-col">Name </th>
                                <th class="nk-tb-col tb-col-mb">Sku</th>
                                <th class="nk-tb-col tb-col-md">Barcode</th>
                                <th class="nk-tb-col tb-col-lg">QTY</th>
                                <th class="nk-tb-col tb-col-md">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody id="order_table">

                            @foreach ($products as $product)
                                
                            <tr class="nk-tb-item">
                                
                                <td class="nk-tb-col">
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $product->id }}<span  class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <div class="user-info">
                                    
                                    @if (count($product->images) <> 0) <img src="{{ $product->images[0]->src }}" alt=""
                                        width="60" height="60">
                                        @endif
                                       
                                </div>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $product->name }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    {{ $product->sku }}
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <input type="text" name="barcode" class="form-control">
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                     <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" id="sub" class="sub border">--</button>
                                    <button type="button" id="sub" class="sub border">-</button>
                                    <input type="number" id="1" value="0" min="0" class="quantity" />
                                    <button type="button" id="add" class="add border">+</button>
                                    <button type="button" id="add" class="add border">++</button>
                                </div>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                   <a class="btn btn-dim btn-sm btn-primary" href="{{ route('products.show',$product->id) }}"><i
                                            class="icon ni ni-eye"></i></a>
                                            <button type="button" class="btn btn-sm btn-dim btn-primary editProduct" onclick="getProduct(this,$product)"
                                        data-productId="{{ $product->id }}" data-productPrice="{{ $product->regular_price }}" data-salePrice="{{ $product->sale_price }}"><i class="icon ni ni-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-dim btn-primary deleteProduct"
                                        data-productId="{{ $product->id }}" d><i class="icon ni ni-trash"></i></button>
                                </td>
                                
                            </tr><!-- .nk-tb-item  -->
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
<div class="modal fade zoom" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Product</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="{{ route('products.index') }}" id="productEditForm" class="form-validate is-alter" method="POST">
                @method('put')
            <div class="modal-body">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="regular_price" class="mb-0">Regular Price</label>
                            <input type="number" name="regular_price" id="regular_price" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sale_price" class="mb-0">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control">
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
@endsection

@section('script')
<script>
    $(document).ready(function () {


        $(".add").click(function () {
            $(this)
                .prev()
                .val(+$(this).prev().val() + 1);

            

        });
        $(".sub").click(function () {
            if ($(this).next().val() > 1) {
                $(this)
                    .next()
                    .val(+$(this).next().val() - 1);
                let inputs = document.querySelectorAll("td  input.quantity");
            }
        });

    });

   function getProduct(e,obj){
    console.log(obj);
   }

</script>
@endsection
