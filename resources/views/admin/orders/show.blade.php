@extends('layouts.admin') @section('title','Order detail') @section('page-title','Order Detail') @section('content')
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
                                        Image
                                    </th>
                                    <th scope="col">Bin Location</th>
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
                                @foreach ($orders['line_items'] as $product)
                                    
                                <tr>
                                    <td></td>
                                    <td></td>
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
                                    <td class="text-success"></td>
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
    $(document.body).on("change", "input.quantity", function () {
        console.log($(this).val())
            var ProductPrice = $(this).parent("td").siblings("td").children("input.price").val();
            var quantity = $(this).val();
            

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
