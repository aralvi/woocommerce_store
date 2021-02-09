@extends('layouts.admin') @section('title','dashboard') @section('page-title','Order Preparation') @section('content')
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
                                @foreach ($orders as $order)
                                    
                                <tr>
                                    <td><img src="{{ asset('assets/images/icons/logo-dark.png') }}" alt="" /></td>
                                    <td>xyz</td>
                                    <td>{{ $order->line_items[0]->quantity }}</td>
                                    <td class="w-296">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" id="sub" class="sub border" onclick="calculateTotal()">--</button>
                                            <button type="button" id="sub" class="sub border" onclick="calculateTotal()" >-</button>
                                            <input type="number" id="1" value="{{ $order->line_items[0]->quantity }}" min="0" class="quantity"/>
                                            <button type="button" id="add" class="add border" onclick="calculateTotal()">+</button>
                                            <button type="button" id="add" class="add border" onclick="calculateTotal()">++</button>
                                        </div>
                                    </td>
                                    <td>{{ $order->line_items[0]->sku }}</td>
                                    <td>supplier1</td>
                                    <td>1001231532143215</td>
                                    <td>{{ $order->line_items[0]->name }}</td>
                                    <td class="text-success">{{ $order->status }}</td>
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
    
    $(".add").click(function () {
        $(this)
            .prev()
            .val(+$(this).prev().val() + 1);
        
    });
    $(".sub").click(function () {
        if ($(this).next().val() > 1 || $(this).next().next().val() > 1) {
            $(this)
                .next()
                .val(+$(this).next().val() - 1);
            $(this)
                .next()
                .next()
                .val(+$(this).next().next().val() - 1);
        }
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

            $(document).ready(function(){

                $.ajax({

                    type : 'GET',
                    url: "{{ url('api/orders') }}",
                    success:function(data){
                        console.log(data.success.status);
                    }
                });
            });






</script>
@endsection
