@extends('layouts.admin') @section('title','dashboard') @section('page-title','Order Preparation') @section('content')
<div class="col-xxl-12 col-sm-12">
    <div class="card">
        <div class="nk-ecwg nk-ecwg6">
            <div class="card-inner">
                {{-- card header section --}}
                <div class="card-title-group" >
                    
                    
                </div>
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
                                        <tr>
                                           
                                            <td><img src="{{ asset('assets/images/icons/logo-dark.png') }}" alt=""></td>
                                            <td>xyz</td>
                                            <td>4</td>
                                            <td class="w-296">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button type="button" id="sub" class="sub border">--</button>
                                                    <button type="button" id="sub" class="sub border">-</button>
                                                    <input type="number" id="1" value="1" min="0"  />
                                                    <button type="button" id="add" class="add border">+</button>
                                                    <button type="button" id="add" class="add border">++</button>
                                                </div>
                                            </td>
                                            <td>10001</td>
                                            <td>supplier1</td>
                                            <td>1001231532143215</td>
                                            <td>Demo product</td>
                                            <td class="text-success">success</td>
                                        </tr>
                                        <tr>
                                           
                                            <td><img src="{{ asset('assets/images/icons/logo-dark.png') }}" alt=""></td>
                                            <td>xyz</td>
                                            <td>4</td>
                                            <td class="w-296">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button type="button" id="sub" class="sub border">--</button>
                                                    <button type="button" id="sub" class="sub border">-</button>
                                                    <input type="number" id="1" value="1" min="0"  />
                                                    <button type="button" id="add" class="add border">+</button>
                                                    <button type="button" id="add" class="add border">++</button>
                                                </div>
                                            </td>
                                            <td>10001</td>
                                            <td>supplier1</td>
                                            <td>1001231532143215</td>
                                            <td>Demo product</td>
                                            <td class="text-success">success</td>
                                        </tr>
                                        <tr>
                                           
                                            <td><img src="{{ asset('assets/images/icons/logo-dark.png') }}" alt=""></td>
                                            <td>xyz</td>
                                            <td>4</td>
                                            <td class="w-296">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button type="button" id="sub" class="sub border">--</button>
                                                    <button type="button" id="sub" class="sub border">-</button>
                                                    <input type="number" id="1" value="1" min="0"  />
                                                    <button type="button" id="add" class="add border">+</button>
                                                    <button type="button" id="add" class="add border">++</button>
                                                </div>
                                            </td>
                                            <td>10001</td>
                                            <td>supplier1</td>
                                            <td>1001231532143215</td>
                                            <td>Demo product</td>
                                            <td class="text-warning">success</td>
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <th colspan="3" class="text-right pt-3">Total Weight</th>
                                        <td><input type="number" name="" id="" class=" form-control"></td>
                                        <th colspan="3" class="text-right pt-3">Product count</th>
                                        <td colspan="2"><input type="number" name="" id="" class=" form-control"></td>
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
@endsection
@section('script')
    <script>
        $('.add').click(function () {
    	    $(this).prev().val(+$(this).prev().val() + 1);
    	    $(this).prev().prev().val(+$(this).prev().val() + 1);
        });
        $('.sub').click(function () {
                if ($(this).next().val() > 1 || $(this).next().next().val() > 1) {
                
                $(this).next().val(+$(this).next().val() - 1);
                $(this).next().next().val(+$(this).next().next().val() - 1);
                }
        });
    </script>
@endsection