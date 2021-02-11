@extends('layouts.admin') @section('title','Order detail') @section('page-title','Order Detail') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group"></div>
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
                                            <button type="button" id="sub" class="sub border" >--</button>
                                            <button type="button" id="sub" class="sub border"  >-</button>
                                            <input type="number" id="1" value="{{ $product->quantity }}" min="0" class="quantity"/>
                                            <button type="button" id="add" class="add border" >+</button>
                                            <button type="button" id="add" class="add border" >++</button>
                                        </div>
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @foreach ($products as $item)
                                        @if ($product->product_id == $item->id)
                                            <p class="{{ $item->stock_status == 'instock'? "text-success":'text-danger' }} ">{{ $item->stock_status }}</p>
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
                    <table class=" datatable-init nk-tb-list nk-tb-ulist col-md-12" data-auto-responsive="false">
                        <thead >
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        #
                                    </div>
                                </th>
                                <th class="nk-tb-col ">Image</th>
                                <th class="nk-tb-col tb-col-mb ">Qty to ship</th>
                                <th class="nk-tb-col tb-col-md "><button class="border-0">-</button> Qty <button class="border-0">+</button></th>
                                <th class="nk-tb-col tb-col-lg ">Sku</th>
                                <th class="nk-tb-col tb-col-lg ">supplier</th>
                                <th class="nk-tb-col tb-col-md ">Barcode</th>
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
                                            <img src="{{ $item->images[0]->src }}" alt="" width="60" height="60">
                                        @endif
                                        @endforeach
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">{{ $product->quantity }}</span>
                                </td>
                                <td >
                                   <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" id="sub" class="sub border" >--</button>
                                            <button type="button" id="sub" class="sub border"  >-</button>
                                            <input type="number" id="1" value="0" min="0" class="quantity"/>
                                            <button type="button" id="add" class="add border" >+</button>
                                            <button type="button" id="add" class="add border" >++</button>
                                        </div>
                                </td>
                                <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                    {{ $product->sku }}
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <input type="text" name="barcode" class="form-control">
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    {{ $product->name }}
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                   @foreach ($products as $item)
                                        @if ($product->product_id == $item->id)
                                            <p class="{{ $item->stock_status == 'instock'? "text-success":'text-danger' }} ">{{ $item->stock_status }}</p>
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
                                <td colspan="2"><input type="number" name="" id="" class="form-control count" /></td>
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
@endsection @section('script')
<script>
    
$(document).ready(function(){
    
calculateTotal();

    $(".add").click(function () {
        $(this)
            .prev()
            .val(+$(this).prev().val() + 1);
             
            let inputs = document.querySelectorAll("td  input.quantity");
    
                let sum = 0;
                for (let input of inputs) {
                    sum += +input.value;
                }
    
                let grandTotal = document.querySelector(".count");
    
                // console.log(sum);
                grandTotal.value = sum;
        
    });
    $(".sub").click(function () {
        if ($(this).next().val() > 1 ) {
            $(this)
                .next()
                .val(+$(this).next().val() - 1);
                let inputs = document.querySelectorAll("td  input.quantity");
    
                let sum = 0;
                for (let input of inputs) {
                    sum += +input.value;
                }
    
                let grandTotal = document.querySelector(".count");
    
                // console.log(sum);
                grandTotal.value = sum;
            
        }
    });
   
});
        function calculateTotal() {
                let inputs = document.querySelectorAll("td  input.quantity");
    
                let sum = 0;
                for (let input of inputs) {
                    sum += +input.value;
                }
    
                let grandTotal = document.querySelector(".count");
    
                // console.log(sum);
                grandTotal.value = sum;
            }

           






</script>
@endsection
